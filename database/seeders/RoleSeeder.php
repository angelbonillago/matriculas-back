<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //$role1 = Role::create(['name' => 'Admin']);
        //$role2 = Role::create(['name' => 'Student']);

        $adminRole = Role::create(['name' => 'Admin']);
        $studentRole = Role::create(['name' => 'Student']);

        Permission::create(['name' => 'crear-estudiante']);
        Permission::create(['name' => 'crear-curso']);
        Permission::create(['name' => 'matricular-alumno-curso']);
        Permission::create(['name' => 'matricular']);

        $adminRole->givePermissionTo(['crear-estudiante', 'crear-curso', 'matricular-alumno-curso']);
        $studentRole->givePermissionTo('matricular');
    }
}
