<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategory;
class CreateSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::create([
            'category_id' => 1,
            'name' => 'Dell',
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name' => 'HP',
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name' => 'lenovo',
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name' => 'Apple',
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name' => 'Samsung',
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name' => 'Huawei',
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name' => 'LG',
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name' => 'Hitachi',
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name' => 'Toshiba',
        ]);
    }
}
