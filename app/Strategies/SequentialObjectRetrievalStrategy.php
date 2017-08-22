<?php

namespace Mooncascade\Strategies;

/**
 * Class SequentialObjectRetrievalStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class SequentialObjectRetrievalStrategy extends AbstractObjectRetrievalStrategy
{
    /**
     * Simple Object retreival strategy intended to
     * retrieve objects by a given parameter.
     *
     * @return mixed
     */
    public function execute()
    {
        return $this->repository->findOneBy($this->criteria);
    }

}
