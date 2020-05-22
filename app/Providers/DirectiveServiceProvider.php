<?php

namespace App\Providers;

use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use function PHPSTORM_META\type;

class DirectiveServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        $this->vuePropsDirectives();
        $this->routeIsDirectives();
    }

    private function vuePropsDirectives()
    {
        Blade::directive('vue_props', function ($props) {
            return '<?php echo vue_props($props); ?>';
        });
    }

    private function routeIsDirectives()
    {
        Blade::if('routeis', function (...$route) {
            $guard = \Auth::getDefaultDriver();
            $route = preg_filter('/^/', $guard.'.', $route);
            foreach ($route as $item){
                if (Route::currentRouteNamed($item)){
                    return true;
                }
            }
            return false;
        });
    }
}
