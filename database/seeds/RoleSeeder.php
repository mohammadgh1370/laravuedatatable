<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Schema::disableForeignKeyConstraints();
        \Spatie\Permission\Models\Role::truncate();
        $roles = [
            'admin' => [
                'admin'     => [
                    'label' => 'مدیر اصلی',
                ],
                'operator'  => [
                    'label'      => 'اپراتور',
                    'permission' => [
                        'user_index',
                        'user_create',
                        'user_edit',
                    ]
                ],
                'writer'    => [
                    'label'      => 'نویسنده',
                    'permission' => [
//                        'user_index','user_create','user_edit',
                    ]
                ],
                'supporter' => [
                    'label'      => 'پشتیبان',
                    'permission' => [
                        'user_index'
                    ]
                ],
            ]
        ];
        foreach ($roles as $guard => $role) {
            foreach ($role as $role_name => $item) {
                $role_created = \Spatie\Permission\Models\Role::create([
                    'guard_name' => $guard,
                    'name'       => $role_name,
                    'label'      => $item['label']
                ]);
                if ($role_name != 'admin') {
                    $role_created->syncPermissions(Permission::whereIn('name', $item['permission'] ?? [])->get());
                }
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
