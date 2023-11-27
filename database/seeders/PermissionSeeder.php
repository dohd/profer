<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan make:seed PermissionSeeder
        // php artisan db:seed --class=PermissionSeeder

        $permissions = [];
        $items = ['proposal', 'budgeting', 'log-frame', 'action-plan', 'agenda', 'attendance', 'narrative-report', 'case-study', 'user'];
        foreach ($items as $i => $item) {
            foreach (['create', 'edit', 'delete', 'view'] as $j => $verb) {
                $permissions[] = [
                    'name' => $verb . '-' . $item, 
                    'guard_name' => 'web'
                ];
            }
        }
        DB::table('permissions')->insert($permissions);
        $role = Role::findById(1);
        $permissions = array_map(fn($v) => $v['name'], $permissions);
        // $permissions = Permission::find();
        // $role->givePermissionTo($permissions);
    }
}
