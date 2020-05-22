# Laravue Datatable

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
3- composer install and npm run install then npm run awatch.
4- this project use sqlite in database/database.sqlite root directory and set -> DB_CONNECTION=sqlite in .env file.
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

