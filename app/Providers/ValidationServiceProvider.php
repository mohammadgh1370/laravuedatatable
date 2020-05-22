<?php

namespace App\Providers;

use App\Validations\ValidationMessages;
use App\Validations\ValidationRules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    private $validationRules = [
        'iran_mobile'                   => 'IranMobile',
        'sheba'                         => 'Sheba',
        'melli_code'                    => 'MelliCode',
    ];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ValidationRules', ValidationRules::class);

        $this->app->bind('ValidationMessages', ValidationMessages::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach($this->validationRules as $name => $method)
        {
            Validator::extend($name, 'App\Validations\ValidationRules@'.$method);

            Validator::replacer($name, 'App\Validations\ValidationMessages@Msg');
        }
    }
}
