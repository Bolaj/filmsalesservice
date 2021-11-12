<?php

namespace Database\Seeders;
Use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'username' => 'Admin',
            'email' =>'admin@gmail.com',
            'password' => bcrypt('password')
        ];

        Admin::create($admin);
    }
}
