<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Product::factory()->count(10)->create();
        Schema::enableForeignKeyConstraints();
    }
}
