<?php

use App\Models\Bio;
use App\Models\Info;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\User::truncate();
        \App\Models\Info::truncate();
        $user = \App\Models\User::create([
            'name'              => 'mohammad',
            'family'            => 'ghorbani',
            'email'             => 'mohammadghorbani@gmail.com',
            'mobile'            => '09909999999',
            'email_verified_at' => now(),
            'password'          => \Illuminate\Support\Facades\Hash::make('123456789'),
            'remember_token'    => Str::random(10),
        ]);

        factory(Info::class)->create(['user_id' => $user->id]);

        factory(User::class, 50)->create()->each(function ($user) {
            factory(Info::class)->create(['user_id' => $user->id]);
        });
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }
}
