<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WidgetSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->assignPermissions();
    }

    protected function assignPermissions()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $allPermissions = Permission::all()->pluck('id')->toArray();
        if ($adminRole) {
            $adminRole->permissions()->sync($allPermissions);
        }
        if ($editorRole) {
            $editorRole->permissions()->sync(
                Permission::whereIn('name', [
                    'view_post', 'create_post', 'edit_post',
                    'view_product',
                ])->pluck('id')->toArray()
            );
        }
        $user = User::find(1);
        if ($user && $adminRole) {
            $user->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
}
