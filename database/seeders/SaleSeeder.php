<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $sale = Sale::create();
            $products = Product::all();
            foreach ($products as $product)
                if (rand(0, 1))
                    ProductSale::create(['product_id' => $product->id, 'sale_id' => $sale->id, 'product_amount' => rand(0, $product->amount)]);

            $products = $sale->products;
            if ($sale->products->count() == 0) {
                $sale->delete();
            } else {
                $total_amount = 0;
                $total_value = 0;

                foreach ($products as $product) {
                    $total_amount = $total_amount + $product->pivot->product_amount;
                    $total_value = $total_value + ($product->pivot->product_amount * $product->price);
                }

                $sale->update(['total_amount' => $total_amount, 'total_value' => $total_value]);
            }
        }
    }
}
