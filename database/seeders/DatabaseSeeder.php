<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateCategorySeeder::class);
        $this->call(CreateSubCategorySeeder::class);
        $this->call(CreateProductSeeder::class);
    }
}
