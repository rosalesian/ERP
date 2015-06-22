<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {    
        /*Autoload modules*/
        $files = new FileSystem;

        $modules = $files->directories( app_path() . '/modules');
  
        while (list(,$module) = each($modules)) {
            if(file_exists($module.'/routes.php')) {
                include $module.'/routes.php';
            }
            if(is_dir($module.'/Views')) {
                $this->loadViewsFrom($module.'/Views', basename($module));                
            }

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
