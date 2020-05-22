<?php

namespace App\Datatables\Admin;

use Laravue\Datatable\Classes\Datatable;

class UserDatatable extends Datatable
{

    public function url()
    {
        return route('admin.user.index');
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
                "label"     => "نام کامل",
                "name"      => "full_name",
                "orderable" => true,
            ],
            [
                "label"     => "موبایل",
                "name"      => "mobile",
                "orderable" => true,
            ],
            [
                "label"     => "قد",
                "name"      => "info.height",
                "orderable" => true,
            ],
            [
                "label"     => "وزن",
                "name"      => "info.weight",
                "orderable" => true,
            ],
            [
                "label"     => "گروه خونی",
                "name"      => "info.blood_type",
                "orderable" => true,
            ],
            [
                "label"      => "عملیات",
                "orderable"  => false,
                "components" => [
                    [
                        "name"            => "مشاهده",
                        "classes"         => [
                            "button" => [
                                "btn"         => true,
                                "btn-warning" => true,
                                "btn-sm"      => true,
                                "btn-block"   => true
                            ],
                            "icon"   => [
                                "fa"     => true,
                                "fa-eye" => true
                            ]
                        ],
                        "href"            => route('admin.user.show'),
                        "handler"         => "page",
//                        "component" => "data-table-button",
                        "access"          => $this->checkPermission('index')
                    ],
                    [
                        "name"            => "ویرایش",
                        "classes"         => [
                            "button" => [
                                "btn"         => true,
                                "btn-success" => true,
                                "btn-sm"      => true,
                                "btn-block"   => true
                            ],
                            "icon"   => [
                                "fa"        => true,
                                "fa-pencil" => true
                            ]
                        ],
                        "event"           => "click",
                        "handler"         => "modal",
//                        "component" => "data-table-button",
                        "modalComponent"  => "edit-user",
                        "access"          => $this->checkPermission('edit')
                    ],
                    [
                        "name"            => "حذف",
                        "classes"         => [
                            "button" => [
                                "btn"        => true,
                                "btn-danger" => true,
                                "btn-sm"     => true,
                                "btn-block"  => true,
                                "box-right"  => true
                            ],
                            "icon"   => [
                                "far"      => true,
                                "fa-trash-alt" => true
                            ]
                        ],
                        "handler"         => "action",
                        "method"          => "delete",
                        "href"            => route('admin.user.delete'),
//                        "component" => "data-table-button",
                        "access"          => $this->checkPermission('delete')
                    ],
                    [
                        "name"            => "active ? `غیرفعال` : `فعال`",
                        "classes"         => [
                            "button" => [
                                "btn"         => true,
                                "btn-secondary"    => "active ? true : false",
                                "btn-outline-secondary" => "active ? false : true",
                                "btn-sm"      => true,
                                "btn-block"   => true
                            ],
                            "icon"   => [
                                "fa"      => true,
                                "fa-toggle-off" => "active ? true : false",
                                "fa-toggle-on" => "active ? false : true"
                            ]
                        ],
                        "handler"         => "action",
                        "method"          => "get",
                        "href"            => route('admin.user.active'),
//                        "component" => "data-table-button",
                        "access"          => $this->checkPermission('edit')
                    ]
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
        $ability = 'user_'.$persmission;
        if (!request()->user()->can($ability))
            if (!request()->user()->hasPermissionTo($ability, 'admin')) {
                return false;
            }
        return true;
    }
}
