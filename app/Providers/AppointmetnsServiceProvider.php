<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppointmetnsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       view()->composer('*',function($view){
        $view->with(['appointmentsList' =>['9:00AM : 12:00PM','12:00PM : 3:00PM','3:00PM : 6:00PM','6:00PM : 9:00PM','9:00PM : 11:00PM']]);
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
