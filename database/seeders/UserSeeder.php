<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'user_group_id' => 1,
        ]);

        User::create([
            'name' => 'testqa',
            'email' => 'testqa@gmail.com',
            'password' => Hash::make('12345678'),
            'user_group_id' => 2,
        ]);

        User::create([
            'name' => 'testrd',
            'email' => 'testrd@gmail.com',
            'password' => Hash::make('12345678'),
            'user_group_id' => 3,
        ]);

        User::create([
            'name' => 'testpm',
            'email' => 'testpm@gmail.com',
            'password' => Hash::make('12345678'),
            'user_group_id' => 4,
        ]);
    }
}
