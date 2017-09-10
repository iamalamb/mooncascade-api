<?php

namespace Mooncascade\Contracts\Managers;

/**
 * Interface MooncascadeFCMManager
 *
 * Primary Laravel "Contract" intended for
 * implementation by any concrete implementations
 * of the MooncascadeFCMManager.
 *
 * It integrates Laravel-FCM with the application.
 *
 * @see https://laravel.com/docs/5.4/contracts
 * @see https://github.com/brozot/Laravel-FCM
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface MooncascadeFCMManager
{
    /**
     * Execute function intended to handle
     * any underlying interactions with Laravel-FCM.
     *
     * @param array $data
     * @return mixed
     */
    public function execute(array $data);
}