<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CreateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Laptop',
            'slug' => 'laptop',
            'description' => 'laptop is the main',
            'image' => 'files/sample_one.png',
        ]);
        Category::create([
            'name' => 'Mobile',
            'slug' => 'mobile',
            'description' => 'mobile is the not main',
            'image' => 'files/sample_two.png',
        ]);
        Category::create([
            'name' => 'Electric devices',
            'slug' => 'electric_devices',
            'description' => 'electric devices is the main of',
            'image' => 'files/sample_three.png',
        ]);
    }
}
