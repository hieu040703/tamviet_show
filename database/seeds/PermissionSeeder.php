<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'view_post', 'display_name' => 'Xem bài viết'],
            ['name' => 'create_post', 'display_name' => 'Thêm bài viết'],
            ['name' => 'edit_post', 'display_name' => 'Sửa bài viết'],
            ['name' => 'delete_post', 'display_name' => 'Xóa bài viết'],

            ['name' => 'view_product', 'display_name' => 'Xem sản phẩm'],
            ['name' => 'create_product', 'display_name' => 'Thêm sản phẩm'],
            ['name' => 'edit_product', 'display_name' => 'Sửa sản phẩm'],
            ['name' => 'delete_product', 'display_name' => 'Xóa sản phẩm'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm['name']],
                ['display_name' => $perm['display_name']]
            );
        }
    }
}
