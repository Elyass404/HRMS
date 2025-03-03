<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // hadchi to make the available roles in your platform 
        $adminRole = Role::create(['name' => 'Admin',"guard_name"=>"web"]);
        $hrRole = Role::create(['name' => 'HR',"guard_name"=>"web"]);
        $employeeRole =  Role::create(["name"=>"Employee","guard_name"=>"web"]);
        $managerRole= Role::create(["name"=>"Manager","guard_name"=>"web"]);

        // hna we are creating a table of all permission in our platform, so we make a for loop to insert them rapidly instead of writing each line individually
        $permissions = [
            "employee all add",
            "employee all edit",
            "employee all delete",
            "employee all view",
            "employee add",
            "employee edit",
            "employee delete",
            "employee view",
            "department add",
            "department edit",
            "department delete",
            "department view",
            "contract type add",
            "contract type edit",
            "contract type delete",
            "contract type view",
            "role add",
            "role edit",
            "role delete",
            "role view",
            "formation assign",
            "formation delete",
            "formation edit",
        ];

        // to add the permissions into the table of permissions in the database
        foreach($permissions as $permission){
            Permission::create(["name"=>$permission,"guard_name"=>"web"]);
        }

        //now assigning each permission to its role 

        $adminRole->givePermissionTo($permissions);

        $hrRole->givePermissionTo([
            "employee all add",
            "employee all edit",
            "employee all delete",
            "employee all view",
            "department add",
            "department edit",
            "department delete",
            "department view",
            "contract type add",
            "contract type edit",
            "contract type delete",
            "contract type view",
            "formation assign",
            "formation delete",
            "formation edit"
        ]);

        $managerRole->givePermissionTo([
            "employee all view",
            "department view",
            "formation assign",
            "formation delete",
            "formation edit"
        ]);

        $employeeRole->givePermissionTo("employee all view");
    }
}
