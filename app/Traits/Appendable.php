<?php

namespace App\Traits;

trait Appendable
{
    use Avatarable;

    public function __construct(array $attributes = [])
    {
        foreach (class_uses_recursive($this) as $trait) {
            if (method_exists($this, $method = 'initialize' . class_basename($trait))) {
                $this->{$method}();
            }
        }
        parent::__construct($attributes);
    }

    public function initializeAppendable() {
        $this->append( 'full_name' );
    }

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->family;
    }
}
