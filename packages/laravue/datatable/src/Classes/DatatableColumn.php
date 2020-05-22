<?php


namespace Laravue\Datatable\Classes;


class DatatableColumn
{
    public $name;
    public $label;
    public $orderable = true;
    public $components = [];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return DatatableColumn
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label ?? $this->getName();
    }

    /**
     * @param mixed $label
     * @return DatatableColumn
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderable()
    {
        return $this->orderable ?? true;
    }

    /**
     * @param mixed $orderable
     * @return bool
     */
    public function setOrderable($orderable = true): bool
    {
        $this->orderable = $orderable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComponents()
    {
//        return $this->components;
        return config('lara-vue-datatable.columns');
    }

    /**
     * @param mixed $components
     * @return DatatableColumn
     */
    public function setComponents(DatatableComponent ...$components)
    {
        $this->components = $components;
        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'orderable' => $this->getOrderable(),
            'components' => $this->getComponents(),
        ];
    }
}