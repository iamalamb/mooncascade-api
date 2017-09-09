<?php

namespace Mooncascade\Providers;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;
use Mooncascade\Entities\Athlete;
use Mooncascade\Http\Controllers\AthleteController;

class MooncascadeControllerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

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
    }

    protected function getRepository(string $class): ObjectRepository
    {
        return $this
            ->app->make(EntityManagerInterface::class)
            ->getRepository($class);
    }
}
