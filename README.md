# Laravue Datatable

### [demo link](http://datatable.ihweb.ir/)

#### About Laravue Datatable

this project write just for test. in this project use three package. one vuejs package and two laravel package:

- [laravel-vue-datatable](https://github.com/jamesdordoy/laravel-vue-datatable).
- [Laravel-Vue-Datatable_Laravel-Package](https://github.com/jamesdordoy/Laravel-Vue-Datatable_Laravel-Package).
- [searchable](https://github.com/nicolaslopezj/searchable).

with change code and structure.

#### test datatable:
```
1- clone or download zip project.
2- generate key -> php artisan key:generate.
3- composer install and npm run install then ->npm run dev and npm run adev.
4- if use sqlite -> touch database/database.sqlite and set -> DB_CONNECTION=sqlite in .env file.
5- migrate tables and seed fake data with -> php artisan migrate --seed.
6- go to this route -> localhost:8000/admin/dashboard.
```

datatable use custom package in base root of project. that use [Laravel-Vue-Datatable_Laravel-Package](https://github.com/jamesdordoy/Laravel-Vue-Datatable_Laravel-Package) package with changes.

this package use [laravel-vue-datatable](https://github.com/jamesdordoy/laravel-vue-datatable).
this exist in resource/js/component/datatable root.


### Feature of laravuedatatable:

- create table columns and another property in backend.
- componentable table such as : image component,button component, ...
- use [spatie/laravel-permissions](https://github.com/spatie/laravel-permission) to acl table actions.

## datatable class of admin example:

```php
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

```

