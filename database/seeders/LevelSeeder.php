<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    
    public function run()
    {
        $levels = [
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Cashier'
            ],
            [
                'name' => 'Customer'
            ]
        ];

        foreach ($levels as $level) {
            Level::create($level);
        }
    }
}
