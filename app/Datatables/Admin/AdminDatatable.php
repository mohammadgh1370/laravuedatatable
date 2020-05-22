<?php

namespace App\Datatables\Admin;

use Laravue\Datatable\Classes\Datatable;

class AdminDatatable extends Datatable
{

    public function url()
    {
        return route('admin.admin.index');
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
                "label"      => "عکس",
                "components" => [
                    [
                        "name"      => "avatar",
                        "component" => "image-table-tool-tip",
                        "classes"   => [
                            "img-w100" => true
                        ]
                    ]
                ],
                "orderable"  => false,
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
                "label"     => "ایمیل",
                "name"      => "email",
                "orderable" => true,
            ],
            [
                "label"      => "عملیات",
                "orderable"  => false,
                "components" => [
                    [
                        "name"    => "مشاهده",
                        "classes" => [
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
                        "href"    => route('admin.admin.show'),
                        "handler" => "page",
//                        "component" => "data-table-button",
                        "access"  => $this->checkPermission('index')
                    ],
                    [
                        "name"           => "ویرایش",
                        "classes"        => [
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
                        "event"          => "click",
                        "handler"        => "modal",
//                        "component" => "data-table-button",
                        "modalComponent" => "edit-admin",
                        "access"         => $this->checkPermission('edit')
                    ],
                    [
                        "name"    => "حذف",
                        "classes" => [
                            "button" => [
                                "btn"        => true,
                                "btn-danger" => true,
                                "btn-sm"     => true,
                                "btn-block"  => true,
                                "box-right"  => true
                            ],
                            "icon"   => [
                                "far"          => true,
                                "fa-trash-alt" => true
                            ]
                        ],
                        "handler" => "action",
                        "method"  => "delete",
                        "href"    => route('admin.admin.delete'),
//                        "component" => "data-table-button",
                        "access"  => $this->checkPermission('delete')
                    ],
                    [
                        "name"    => "active ? `فعال` : `غیرفعال`",
                        "classes" => [
                            "button" => [
                                "btn"                   => true,
                                "btn-outline-secondary" => "active ? true : false",
                                "btn-secondary"         => "active ? false : true",
                                "btn-sm"                => true,
                                "btn-block"             => true
                            ],
                            "icon"   => [
                                "fa"            => true,
                                "fa-toggle-on"  => "active ? true : false",
                                "fa-toggle-off" => "active ? false : true"
                            ]
                        ],
                        "handler" => "action",
                        "method"  => "get",
                        "href"    => route('admin.admin.active'),
//                        "component" => "data-table-button",
                        "access"  => $this->checkPermission('edit')
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
        $ability = 'admin_' . $persmission;
        if (!request()->user()->can($ability))
            if (!request()->user()->hasPermissionTo($ability, 'admin')) {
                return false;
            }
        return true;
    }
}
