<?php

namespace Mooncascade\Serializers;

use Symfony\Component\Serializer\Serializer;

/**
 * Class JSONSerializer
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class JSONSerializer
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }

    /**
     * @param Serializer $serializer
     * @return JSONSerializer
     */
    public function setSerializer(Serializer $serializer): JSONSerializer
    {
        $this->serializer = $serializer;

        return $this;
    }

    public function serialize($obj, $context)
    {
        return $this->serializer->serialize($obj, 'json', $context);
    }
}
