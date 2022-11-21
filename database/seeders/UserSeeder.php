<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    
    public function run()
    {
        $users = [
            [
                'name'          => 'Admin',
                'username'      => 'admin',
                'email'         => 'admin@mail.com',
                'password'      => bcrypt('admin'),
                'saldo_awal'    => '9000000',
                'saldo_keluar'   => '1000000',
                'level_id'      => '1'
            ],

            [
                'name'          => 'Cashier',
                'username'      => 'cashier',
                'email'         => 'dani@mail.com',
                'password'      => bcrypt('password'),
                'saldo_awal'    => '8000000',
                'level_id'      => '2'
            ],

            [
                'name'          => 'Ahmad',
                'username'      => 'Admad Dani',
                'email'         => 'ahmad@mail.com',
                'password'      => bcrypt('password'),
                'saldo_awal'    => '2000000',
                'level_id'      => '3'
            ],

            [
                'name'          => 'Dodi',
                'username'      => 'Dodi Firmansyah',
                'email'         => 'dodi@mail.com',
                'password'      => bcrypt('password'),
                'saldo_awal'    => '4000000',
                'level_id'      => '3'
            ],  
        ];
        
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
