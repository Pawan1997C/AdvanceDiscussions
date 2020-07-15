<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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

            'email' => 'pchhangani6@gmail.com',

            'password' => bcrypt('admin'),

            'avatar' => 'avatar/admin.jpg',

            'admin' => 1,

        ]);
    }
}
