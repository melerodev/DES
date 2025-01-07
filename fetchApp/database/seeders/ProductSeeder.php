<?php

namespace Database\Seeders;

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
        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $product->name = fake()->word();
            $product->price = fake()->randomFloat(2, 1, 1000);
            $product->save();
        }
    }
}
