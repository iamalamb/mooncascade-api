<?php

namespace Mooncascade\Managers;

use Illuminate\Contracts\Cache\Repository;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Sender\FCMSender;
use Mooncascade\Contracts\Managers\MooncascadeFCMManager as Contract;

/**
 * Class MooncascadeFCMManager
 *
 * Responsible for integrating Laravel-FCM with the
 * application.
 *
 * @see https://github.com/brozot/Laravel-FCM
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class MooncascadeFCMManager implements Contract
{
    /**
     * Holds a reference to the Laravel cache
     * which is where the registered tokens
     * will be stored.
     *
     * @var Repository
     */
    protected $cache;

    /**
     * Holds a reference to the FCMSender object,
     * use to send data to Firebase.
     *
     * @var FCMSender
     */
    protected $fcmSender;

    /**
     * Holds a reference to an injected Laravel-FCM
     * PayloadDataBuilder which is used to build
     * a useable Firebase payload.
     *
     * @var PayloadDataBuilder;
     */
    protected $payloadDataBuilder;

    /**
     * MooncascadeFCMManager constructor.
     * @param Repository $cache
     * @param FCMSender $fcmSender
     * @param PayloadDataBuilder $payloadDataBuilder
     */
    public function __construct(Repository $cache, FCMSender $fcmSender, PayloadDataBuilder $payloadDataBuilder)
    {
        $this->cache = $cache;
        $this->fcmSender = $fcmSender;
        $this->payloadDataBuilder = $payloadDataBuilder;
    }


    /**
     * @inheritdoc
     */
    public function execute(array $data)
    {
        // Check first if we have registered keys to broadcast to
        if ($this->cache->has('tokens')) {

            // Build the data to send
            $this->payloadDataBuilder->addData($data);
            $payload = $this->payloadDataBuilder->build();

            // Submit the request
            $tokens = $this->cache->get('tokens');
            $response = $this->fcmSender->sendTo($tokens, null, null, $payload);

            // Check if we have tokens to remove
            $deleteTokens = $response->tokensToDelete();

            if ($deleteTokens) {
                $this->handleDeleteTokens($deleteTokens);
            }
        }
    }

    /**
     * Firebase expires tokens for a variety of reasons,
     * Laravel-FCM will return an array of tokens to flush.
     *
     * This method simply uses the cache to purge them from
     * the cache.
     *
     * @param array $deleteTokens
     */
    private function handleDeleteTokens(array $deleteTokens)
    {
        // Check if we have tokens to begin with
        if (($this->cache->has('tokens') && ($deleteTokens))) {

            $tokens = $this->cache->get('tokens');

            // Now loop through and remove the expired tokens and remove each
            $total = count($tokens);
            for ($i = 0; $i < $total; $i++) {
                if (($key = array_search($deleteTokens[$i], $tokens)) !== false) {
                    unset($tokens[$key]);
                }
            }

            // Re-save the cached items
            $this->cache->put('tokens', $tokens, 120);
        }
    }


}
