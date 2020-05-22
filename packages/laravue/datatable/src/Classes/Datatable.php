<?php

namespace Laravue\Datatable\Classes;

use Illuminate\Support\Str;

abstract class Datatable
{
    abstract public function url();

    abstract public function columns();

    abstract public function tableClasses();

    abstract public function modalClasses();

    abstract public function orderBy();

    abstract public function orderDir();

    abstract public function perPage();

    abstract public function pagination();

    abstract public function theme();

    abstract public function cellCheck();

    abstract public function translate();

    abstract public function debounceDelay();

    abstract public function addFiltersToUrl();

    abstract public function filters();

    public function toArray()
    {
        $props = [];
        foreach (array_keys(config('lara-vue-datatable')) as $key) {
            $props[Str::kebab($key)] = $this->{$key}() ?
                $this->$key() :
                config('lara-vue-datatable.' . $key);
        }
        return $props;
    }
}