<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'Quản trị hệ thống']
        );

        Role::firstOrCreate(
            ['name' => 'editor'],
            ['display_name' => 'Biên tập viên']
        );

        Role::firstOrCreate(
            ['name' => 'customer'],
            ['display_name' => 'Khách hàng']
        );
    }
}
