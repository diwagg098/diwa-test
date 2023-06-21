<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $products = [
            ['name' => 'kue ultah'],
            ['name' => 'kue lebaran']
       ];

       $variants = [
            ['name' => 'combine'],
            ['name' => 'vanila'],
            ['name' => 'coklat']
       ];

       $categories = [
            ['name' => 'makanan'],
            ['name' => 'minuman']
       ];

       foreach($products as $product) {
            Product::create($product);
       }

       foreach($variants as $variant) {
            Variant::create($variant);
       }

       foreach($categories as $category) {
            Category::create($category);
       }

       ProductVariant::create([
            'product_id' => 1,
            'category_id' => 1,
            'variant_id' => 2,
            'status' => true,
            'price' => 200000,
            'stock' => 20
       ]);

       ProductVariant::create([
            'product_id' => 1,
            'category_id' => 1,
            'variant_id' => 2,
            'status' => true,
            'price' => 30000,
            'stock' => 10
       ]);

       ProductVariant::create([
            'product_id' => 2,
            'category_id' => 1,
            'variant_id' => 2,
            'status' => true,
            'price' => 50000,
            'stock' => 5
       ]);

    }
}
