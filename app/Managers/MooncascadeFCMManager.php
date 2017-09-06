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

            $this->payloadDataBuilder->addData($data);
            $payload = $this->payloadDataBuilder->build();

            $tokens = $this->cache->get('tokens');
            FCM::sendTo($tokens, null, null, $payload);
        }
    }
}
