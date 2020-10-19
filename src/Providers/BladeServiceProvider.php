<?php

namespace Izt\Basics\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('asterisk', function () {
            return "<?php echo '<span style=\"color:red;\">*</span>' ; ?>";
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */

    public function register()
    {
        //
    }
}
