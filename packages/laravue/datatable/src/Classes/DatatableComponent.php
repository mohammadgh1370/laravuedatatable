<?php

namespace Laravue\Datatable\Classes;

class DatatableComponent
{
    private $name;
    private $classes;
    private $event;
    private $href;
    private $handler;
    private $buttonComponent;
    private $modalComponent;
    private $access;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return DatatableComponent
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param mixed $classes
     * @return DatatableComponent
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     * @return DatatableComponent
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param mixed $href
     * @return DatatableComponent
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param mixed $handler
     * @return DatatableComponent
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getButtonComponent()
    {
        return $this->buttonComponent;
    }

    /**
     * @param mixed $buttonComponent
     * @return DatatableComponent
     */
    public function setButtonComponent($buttonComponent)
    {
        $this->buttonComponent = $buttonComponent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModalComponent()
    {
        return $this->modalComponent;
    }

    /**
     * @param mixed $modalComponent
     * @return DatatableComponent
     */
    public function setModalComponent($modalComponent)
    {
        $this->modalComponent = $modalComponent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param mixed $access
     * @return DatatableComponent
     */
    public function setAccess($access)
    {
        $this->access = $access;
        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'classes' => $this->getClasses(),
            'event' => $this->getEvent(),
            'href' => $this->getHref(),
            'buttonComponent' => $this->getButtonComponent(),
            'modalComponent' => $this->getModalComponent(),
            'access' => $this->getAccess(),
        ];
    }
}