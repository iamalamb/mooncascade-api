<?php

namespace Mooncascade\Managers;

/**
 * Interface MooncascadeFCMManagerInterface
 */
interface MooncascadeFCMManagerInterface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data);

    /**
     * @param array $tokens
     */
    public function handleDeleteTokens(array $tokens);
}
