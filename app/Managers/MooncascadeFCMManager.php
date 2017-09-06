<?php

namespace Mooncascade\Managers;

use Illuminate\Contracts\Cache\Repository;
use LaravelFCM\Message\PayloadDataBuilder;
use FCM;

/**
 * Class MooncascadeFCMManager
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class MooncascadeFCMManager implements MooncascadeFCMManagerInterface
{
    /**
     * @var Repository
     */
    protected $cache;

    /**
     * @var PayloadDataBuilder;
     */
    protected $payloadDataBuilder;

    /**
     * MooncascadeFCMManager constructor.
     * @param Repository $cache
     * @param PayloadDataBuilder $payloadDataBuilder
     */
    public function __construct(Repository $cache, PayloadDataBuilder $payloadDataBuilder)
    {
        $this->cache = $cache;
        $this->payloadDataBuilder = $payloadDataBuilder;
    }


    /**
     * @param array $data
     * @return mixed
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
            $response = FCM::sendTo($tokens, null, null, $payload);

            // Check if we have tokens to remove
            $deleteTokens = $response->tokensToDelete();

            if ($deleteTokens) {
                $this->handleDeleteTokens($deleteTokens);
            }
        }
    }

    /**
     * @param array $deleteTokens
     */
    public function handleDeleteTokens(array $deleteTokens)
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
