<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class CreateProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Dell Laptops',
            'image' => 'product/laptop.jpg',
            'price' => rand(700,1000),
            'description' => 'this is laptop',
            'additional_info' => 'this is laptop additional info',
            'category_id' => 1,
            'subcategory_id' => 1,
        ]);
        Product::create([
            'name' => 'Iphone X',
            'image' => 'product/iphone.png',
            'price' => rand(1000,1300),
            'description' => 'this is iphone',
            'additional_info' => 'this is iphone additional info',
            'category_id' => 2,
            'subcategory_id' => 4,
        ]);
        Product::create([
            'name' => 'Fridge',
            'image' => 'product/fridge.png',
            'price' => rand(4000,5000),
            'description' => 'this is firdge',
            'additional_info' => 'this is fridge additional info',
            'category_id' => 3,
            'subcategory_id' => 8,
        ]);
    }
}
