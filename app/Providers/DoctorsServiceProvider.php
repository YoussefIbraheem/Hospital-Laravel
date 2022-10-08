<?php

namespace App\Providers;

use App\Models\Doctor;
use Illuminate\Support\ServiceProvider;

class DoctorsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with(['doctorsView'=>Doctor::all()]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
