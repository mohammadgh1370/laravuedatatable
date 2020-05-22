<?php

namespace App\Datatables\Admin;

use Laravue\Datatable\Classes\Datatable;

class RoleDatatable extends Datatable
{

    public function url()
    {
        return route('admin.role.index');
    }

    public function columns()
    {
        return [
            [
                "label"     => "#",
                "name"      => "iteration",
                "orderable" => false,
            ],
            [
                "label"     => "شناسه",
                "name"      => "id",
                "orderable" => true,
            ],
            [
                "label"     => "برچسب",
                "name"      => "label",
                "orderable" => true,
            ],
            [
                "label"     => "نوع",
                "name"      => "guard_name",
                "orderable" => true,
            ],
            [
                "label"      => "عملیات",
                "orderable"  => false,
                "components" => [
                    [
                        "name"           => "ویرایش",
                        "classes"        => [
                            "button" => [
                                "btn"         => true,
                                "btn-success" => true,
                                "btn-sm"      => true,
                                "mx-1"        => true
                            ],
                            "icon"   => [
                                "fa"        => true,
                                "fa-pencil" => true
                            ]
                        ],
                        "event"          => "click",
                        "handler"        => "modal",
//                        "component" => "data-table-button",
                        "modalComponent" => "edit-role",
                        "access"         => $this->checkPermission('edit')
                    ],
                    [
                        "name"    => "حذف",
                        "classes" => [
                            "button" => [
                                "btn"        => true,
                                "btn-danger" => true,
                                "btn-sm"     => true,
                                "mx-1"       => true,
                                "box-right"  => true
                            ],
                            "icon"   => [
                                "far"          => true,
                                "fa-trash-alt" => true
                            ]
                        ],
                        "handler" => "action",
                        "method"  => "delete",
                        "href"    => route('admin.role.delete'),
//                        "component" => "data-table-button",
                        "access"  => $this->checkPermission('delete')
                    ],
                ]
            ],
        ];
    }

    public function tableClasses()
    {
        // TODO: Implement tableClasses() method.
    }

    public function modalClasses()
    {
        return [
            "modal-lg"              => true,
            "modal-dialog-centered" => true
        ];
    }

    public function orderBy()
    {
        // TODO: Implement orderBy() method.
    }

    public function orderDir()
    {
        // TODO: Implement orderDir() method.
    }

    public function perPage()
    {
        // TODO: Implement perPage() method.
    }

    public function pagination()
    {
        // TODO: Implement pagination() method.
    }

    public function theme()
    {
        return 'light';
    }

    public function cellCheck()
    {
        // TODO: Implement cellCheck() method.
    }

    public function translate()
    {
        return [
            "nextButton"        => "بعدی",
            "previousButton"    => "قبلی",
            "placeholderSearch" => "جستجو در جدول ...",
        ];
    }

    public function debounceDelay()
    {
        // TODO: Implement debounceDelay() method.
    }

    public function addFiltersToUrl()
    {
        // TODO: Implement addFiltersToUrl() method.
    }

    public function filters()
    {
        // TODO: Implement filters() method.
    }

    private function checkPermission($persmission)
    {
        $ability = 'role_'.$persmission;
        if (!request()->user()->can($ability))
            if (!request()->user()->hasPermissionTo($ability, 'admin')) {
                return false;
            }
        return true;
    }
}
