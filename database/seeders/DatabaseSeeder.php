<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ArticleSeeder::class)
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $users=User::factory(10)->create();
        $role = Role::findByName('user');
        $role->users()->attach($users);

    }
}
