<?php

namespace projetoMilhas\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Importacao do arquivo para ultilizacao do Crawler  
        require_once __DIR__ . '/../Crawler/simple_html_dom.php';
    }
}
