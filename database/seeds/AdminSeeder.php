<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\Admin::truncate();
        $admin = \App\Models\Admin::create([
            'name'              => 'mohammad',
            'family'            => 'ghorbani',
            'email'             => 'mohammadghorbani@gmail.com',
            'mobile'            => '09123456789',
            'email_verified_at' => now(),
            'password'          => \Illuminate\Support\Facades\Hash::make('123456789'),
            'remember_token'    => Str::random(10),
            'active'            => true
        ]);
        $admin->assignRole('admin');
        factory(\App\Models\Admin::class, 5)->create();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }
}
