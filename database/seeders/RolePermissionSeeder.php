<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name'=>'admin']);
        $editor = Role::create(['name'=>'editor']);

        $permissions = ["edit","create","delete","view"];

        foreach($permissions as $permission){
            Permission::create(['name' =>$permission]);
        }
        $admin->givePermissionTo('view','edit');
        $editor->givePermissionTo('view','edit');
    }
}
