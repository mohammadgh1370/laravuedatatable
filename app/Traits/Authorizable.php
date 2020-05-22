<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait Authorizable
{
    private $abilities = [
        'index'   => 'index',
        'show'    => 'index',
        'edit'    => 'edit',
        'update'  => 'edit',
        'create'  => 'create',
        'store'   => 'create',
        'destroy' => 'delete'
    ];

    /**
     * override of callAction to perform the authorization before
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
//        if ($ability = $this->getAbility($method)) {
//            $this->authorize($ability);
//        }
        if ($ability = $this->getAbility($method)) {
            if (!request()->user()->can($ability))
                if (!request()->user()->hasPermissionTo($ability, \Auth::getDefaultDriver())) {
                    abort(403);
                }
        }

        return parent::callAction($method, $parameters);
    }

    public function getAbility($method)
    {
        $routeName = explode('.', \Request::route()->getName());
        $routeName = sizeof($routeName) > 2 ? $routeName[1] : $routeName[0];
        $action    = Arr::get($this->getAbilities(), $method);

        return $action ? $routeName . '_' . $action : null;
    }

    private function getAbilities()
    {
        return $this->abilities;
    }

    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}