<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'category-show',
            'category-trashed',
            'category-trashed-restore',
            'category-trashed-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'product-show',
            'product-trashed',
            'product-trashed-restore',
            'product-trashed-delete',
            'imageSlider-list',
            'imageSlider-create',
            'imageSlider-edit',
            'imageSlider-delete',
            'imageSlider-show',
            'imageSlider-trashed',
            'imageSlider-trashed-restore',
            'imageSlider-trashed-delete',
            'gallery-list',
            'gallery-create',
            'gallery-edit',
            'gallery-delete',
            'gallery-show',
            'gallery-trashed',
            'gallery-trashed-restore',
            'gallery-trashed-delete',
         ];

          // Looping and Inserting Array's Permissions into Permission Table
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
