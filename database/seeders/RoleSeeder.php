<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roleUser = Role::create(['name' => 'user']);
        Permission::create(['name' => 'dashboard'])->assignRole($roleUser);
        $roleAdmin = Role::create(['name' => 'admin']);
        Permission::create(['name' => 'admin.index'])->assignRole($roleAdmin); //ver admin dashboard
        Permission::create(['name' => 'user.index'])->assignRole($roleAdmin);
        Permission::create(['name' => 'user.store'])->assignRole($roleAdmin);
        Permission::create(['name' => 'user.create'])->assignRole($roleAdmin);
        Permission::create(['name' => 'user.show'])->assignRole($roleAdmin);
        Permission::create(['name' => 'user.update'])->assignRole($roleAdmin);
        Permission::create(['name' => 'user.patch'])->assignRole($roleAdmin);
        Permission::create(['name' => 'user.destroy'])->assignRole($roleAdmin);
        Permission::create(['name' => 'user.edit'])->assignRole($roleAdmin);
        Permission::create(['name' => 'user.state'])->assignRole($roleAdmin);
    }
}
