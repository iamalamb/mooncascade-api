<?php

namespace Mooncascade\Providers;

use Mooncascade\Strategies\AthleteRaceStrategyInterface;

class MooncascadeRaceStrategyServiceProvider extends MooncascadeServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $min = $this->options['delay_athlete_execution_min_threshold'];
        $max = $this->options['delay_athlete_execution_min_threshold'];

        $this
            ->app
            ->when(AthleteRaceStrategyInterface::class)
            ->needs('$min')
            ->give($min);

        $this
            ->app
            ->when(AthleteRaceStrategyInterface::class)
            ->needs('$max')
            ->give($max);
    }
}
