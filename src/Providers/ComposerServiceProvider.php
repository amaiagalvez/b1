<?php

namespace Izt\Basics\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Izt\Basics\ViewComposers\MenuComposer;
use Izt\Basics\ViewComposers\VariablesComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('*', VariablesComposer::class);
        View::composer('*', MenuComposer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
