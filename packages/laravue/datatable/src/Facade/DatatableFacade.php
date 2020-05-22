<?php


namespace Laravue\Datatable\Facade;


use Illuminate\Support\Facades\Facade;

class DatatableFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Datatable';
    }
}