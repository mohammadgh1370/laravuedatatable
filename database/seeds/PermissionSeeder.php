<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Schema::disableForeignKeyConstraints();
        \Spatie\Permission\Models\Permission::truncate();
        DB::table(config('permission.table_names.model_has_permissions'))->truncate();
        DB::table(config('permission.table_names.model_has_roles'))->truncate();
        DB::table(config('permission.table_names.role_has_permissions'))->truncate();
        $permissions = [
            'admin' => [
                'dashboard'    => 'مشاهده داشبورد',
                'admin_index'  => 'لیست مدیران',
                'admin_create' => 'ایجاد مدیر',
                'admin_edit'   => 'ویرایش مدیر',
                'admin_delete' => 'حذف مدیر',

                'permission_index'  => 'لیست مجوزها',
                'permission_create' => 'ایجاد مجوز',
                'permission_edit'   => 'ویرایش مجوز',
                'permission_delete' => 'حذف مجوز',

                'role_index'  => 'لیست نقش ها',
                'role_create' => 'ایجاد نقش',
                'role_edit'   => 'ویرایش نقش',
                'role_delete' => 'حذف نقش',

                'user_index'   => 'لیست کاربران',
                'user_create'  => 'ایجاد کاربر',
                'user_edit'    => 'ویرایش کاربر',
                'user_delete'  => 'حذف کاربر',
            ]
        ];
        $data        = [];
        foreach ($permissions as $key => $permission) {
            foreach ($permission as $index => $item) {
                array_push($data, [
                    'guard_name' => $key,
                    'name'       => $index,
                    'label'      => $item,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
            }
        }
        \Spatie\Permission\Models\Permission::insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
