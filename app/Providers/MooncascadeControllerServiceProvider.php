<?php

namespace Mooncascade\Providers;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;
use Mooncascade\Entities\Athlete;
use Mooncascade\Entities\Team;
use Mooncascade\Http\Controllers\AthleteController;
use Mooncascade\Http\Controllers\TeamController;

class MooncascadeControllerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this
            ->app
            ->when(AthleteController::class)
            ->needs(ObjectRepository::class)
            ->give(
                function () {
                    return $this->getRepository(Athlete::class);
                }
            );

        $this
            ->app
            ->when(TeamController::class)
            ->needs(ObjectRepository::class)
            ->give(
                function () {
                    return $this->getRepository(Team::class);
                }
            );
    }

    /**
     * @param string $class
     * @return ObjectRepository
     */
    protected function getRepository(string $class): ObjectRepository
    {
        return $this
            ->app->make(EntityManagerInterface::class)
            ->getRepository($class);
    }
}
