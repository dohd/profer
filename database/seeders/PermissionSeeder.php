<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
    }
}
