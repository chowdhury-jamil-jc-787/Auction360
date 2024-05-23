<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User with Profile
        $superAdmin = User::create([
            'name' => 'mehedi hasan',
            'email' => 'mehedi@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $superAdmin->assignRole('Super Admin');
        Profile::create(['user_id' => $superAdmin->id]);

        // Creating Admin User with Profile
        $admin = User::create([
            'name' => 'john doe',
            'email' => 'john@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('Admin');
        Profile::create(['user_id' => $admin->id]);

        // Creating Product Manager User with Profile
        $productManager = User::create([
            'name' => 'john cena',
            'email' => 'cena@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $productManager->assignRole('Product Manager');
        Profile::create(['user_id' => $productManager->id]);
    }
}

