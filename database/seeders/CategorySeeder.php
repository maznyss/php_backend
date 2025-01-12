<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['name' => 'Bug Fixes'],
            ['name' => 'Best Practices'],
            ['name' => 'New Ideas'],
        ]);
    }
}
