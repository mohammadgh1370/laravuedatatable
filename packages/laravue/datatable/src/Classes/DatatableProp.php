<?php

namespace Laravue\Datatable\Classes;


class DatatableProp
{
    public $url;
    public $columns;
    public $tableClasses;
    public $modalClasses;
    public $orderBy;
    public $orderDir;
    public $perPage;
    public $pagination;
    public $theme;
    public $cellCheck;
    public $translate;
    public $debounceDelay;
    public $addFiltersToUrl;
    public $filters;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return DatatableProp
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param mixed $columns
     * @return DatatableProp
     */
    public function setColumns(DatatableColumn ...$columns)
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTableClasses()
    {
        return $this->tableClasses;
    }

    /**
     * @param mixed $tableClasses
     * @return DatatableProp
     */
    public function setTableClasses($tableClasses)
    {
        $this->tableClasses = $tableClasses;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModalClasses()
    {
        return $this->modalClasses;
    }

    /**
     * @param mixed $modalClasses
     * @return DatatableProp
     */
    public function setModalClasses($modalClasses)
    {
        $this->modalClasses = $modalClasses;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     * @return DatatableProp
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderDir()
    {
        return $this->orderDir;
    }

    /**
     * @param mixed $orderDir
     * @return DatatableProp
     */
    public function setOrderDir($orderDir)
    {
        $this->orderDir = $orderDir;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param mixed $perPage
     * @return DatatableProp
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @param mixed $pagination
     * @return DatatableProp
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $theme
     * @return DatatableProp
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCellCheck()
    {
        return $this->cellCheck;
    }

    /**
     * @param mixed $cellCheck
     * @return DatatableProp
     */
    public function setCellCheck($cellCheck)
    {
        $this->cellCheck = $cellCheck;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTranslate()
    {
        return $this->translate;
    }

    /**
     * @param mixed $translate
     * @return DatatableProp
     */
    public function setTranslate($translate)
    {
        $this->translate = $translate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDebounceDelay()
    {
        return $this->debounceDelay;
    }

    /**
     * @param mixed $debounceDelay
     * @return DatatableProp
     */
    public function setDebounceDelay($debounceDelay)
    {
        $this->debounceDelay = $debounceDelay;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddFiltersToUrl()
    {
        return $this->addFiltersToUrl;
    }

    /**
     * @param mixed $addFiltersToUrl
     * @return DatatableProp
     */
    public function setAddFiltersToUrl($addFiltersToUrl)
    {
        $this->addFiltersToUrl = $addFiltersToUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param mixed $filters
     * @return DatatableProp
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    public function toArray()
    {
        return [
            "url" => $this->geturl() ?? config('lara-vue-datatable.url'),
            "columns" => $this->getcolumns() ?? config('lara-vue-datatable.columns'),
            "tableClasses" => $this->gettableClasses() ?? config('lara-vue-datatable.tableClasses'),
            "modalClasses" => $this->getmodalClasses() ?? config('lara-vue-datatable.modalClasses'),
            "orderBy" => $this->getorderBy() ?? config('lara-vue-datatable.orderBy'),
            "orderDir" => $this->getorderDir() ?? config('lara-vue-datatable.orderDir'),
            "perPage" => $this->getperPage() ?? config('lara-vue-datatable.perPage'),
            "pagination" => $this->getpagination() ?? config('lara-vue-datatable.pagination'),
            "theme" => $this->gettheme() ?? config('lara-vue-datatable.theme'),
            "cellCheck" => $this->getcellCheck() ?? config('lara-vue-datatable.cellCheck'),
            "translate" => $this->gettranslate() ?? config('lara-vue-datatable.translate'),
            "debounceDelay" => $this->getdebounceDelay() ?? config('lara-vue-datatable.debounceDelay'),
            "addFiltersToUrl" => $this->getaddFiltersToUrl() ?? config('lara-vue-datatable.addFiltersToUrl'),
            "filters" => $this->getfilters() ?? config('lara-vue-datatable.filters'),
        ];
    }
}