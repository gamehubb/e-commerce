<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name' => 'yelinnaung', 
            'email' => 'e-commerence@gmail.com',
            'email_verified_at' => NOW(),
            'password' => Hash::make('123456789'),
            'phone_number' => '09967669132',
            'address' => 'Yangon,Myanmar Burma',
            'is_admin' => 1,
        ]);
    }
}
