<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register (): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot (): void {
        if ( config('view.force_https' , false) ) {
            URL::forceScheme('https');
        }
        Schema::defaultStringLength(191);
        Model::unguard();
    }
}
