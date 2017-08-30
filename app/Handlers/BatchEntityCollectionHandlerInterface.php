<?php

namespace Mooncascade\Handlers;

use Illuminate\Support\Collection;


/**
 * Class BatchEntityCollectionHandler
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface BatchEntityCollectionHandlerInterface
{
    /**
     * @param Collection $entites
     */
    public function handle(Collection $entites);
}