<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['name' => 'Espeto', 'price' => 25.99, 'amount' => 10, 'category_id' => Category::inRandomOrder()->first()->id]);
        Product::create(['name' => 'Mangueira', 'price' => 59.99, 'amount' => 10, 'category_id' => Category::inRandomOrder()->first()->id]);
        Product::create(['name' => 'Bacia', 'price' => 19.90, 'amount' => 10, 'category_id' => Category::inRandomOrder()->first()->id]);
    }
}
