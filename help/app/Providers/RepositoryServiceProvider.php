<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //PersonRepository
        $this->app->bind(
            ModelRepositoryInterface::class,
            ModelRepository::class
        );
    }
}
