<?php

namespace Laravue\Datatable;


use Illuminate\Support\ServiceProvider;

class DatatableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        dd(1);
        $this->mergeConfigFrom(
            __DIR__.'/config/lara-vue-datatable.php', 'lara-vue-datatable'
        );
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