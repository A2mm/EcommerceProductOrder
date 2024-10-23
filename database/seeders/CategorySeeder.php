<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Category::factory()->count(10)->create();
        Schema::enableForeignKeyConstraints();
    }
}
