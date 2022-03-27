<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategory;
class CreateSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::create([
            'category_id' => 1,
            'name' => 'Dell',
        ]);
        Subcategory::create([
            'category_id' => 1,
            'name' => 'HP',
        ]);
        Subcategory::create([
            'category_id' => 1,
            'name' => 'lenovo',
        ]);
        Subcategory::create([
            'category_id' => 2,
            'name' => 'Apple',
        ]);
        Subcategory::create([
            'category_id' => 2,
            'name' => 'Samsung',
        ]);
        Subcategory::create([
            'category_id' => 2,
            'name' => 'Huawei',
        ]);
        Subcategory::create([
            'category_id' => 3,
            'name' => 'LG',
        ]);
        Subcategory::create([
            'category_id' => 3,
            'name' => 'Hitachi',
        ]);
        Subcategory::create([
            'category_id' => 3,
            'name' => 'Toshiba',
        ]);
    }
}
