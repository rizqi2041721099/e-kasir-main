<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class CategorySeeder extends Seeder
{
    
    public function run()
    {
        $categories = [
            [
                'name'  => 'minuman',
            ],
            [
                'name'  => 'cemilan',
            ],
        ];

        foreach($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
