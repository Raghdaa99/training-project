<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Create-Student', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Students', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Student', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Student', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Department', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Departments', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Department', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Department', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Field', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Fields', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Field', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Field', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Company', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Companies', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Company', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Company', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Add-Data-Company', 'guard_name' => 'student']);
        Permission::create(['name' => 'Read-Data-Company', 'guard_name' => 'student']);


        Permission::create(['name' => 'Create-Supervisor', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Supervisors', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Supervisor', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Supervisor', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Read-Students-Admin', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Read-Students', 'guard_name' => 'supervisor']);

        Permission::create(['name' => 'Read-Students-Trainer', 'guard_name' => 'trainer']);


            Permission::create(['name' => 'Create-Question', 'guard_name' => 'admin']);
            Permission::create(['name' => 'Read-Questions', 'guard_name' => 'admin']);


    }
}
