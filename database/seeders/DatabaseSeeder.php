<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole=new Role();
        $adminRole->name='admin';
        // \App\Models\User::factory(10)->create();
        $adminRole->save();

        $userRole=new Role();
        $userRole->name="user";
        $userRole->save();
        //php artisan migrate:fresh --seed

        $userAdmin= new User();
        $userAdmin->name="jean Admin";
        $userAdmin->email="jeancarlosrecio@hotmail.com";
        $userAdmin->password=Hash::make("123456789");
        $userAdmin->remember_token =Str::random(10);
        $userAdmin->email_verified_at= Carbon::now()->toDateTimeString();
        $userAdmin->role_id=1;
        $userAdmin->save();

        $userAdmin= new User();
        $userAdmin->name="jean UserTest";
        $userAdmin->email="jean@mail.com";
        $userAdmin->password=Hash::make("123456789");
        $userAdmin->remember_token =Str::random(10);
        $userAdmin->email_verified_at= Carbon::now()->toDateTimeString();
        $userAdmin->role_id=2;
        $userAdmin->save();

        User::factory(10)->create();
        //$this->call(ArticleSeeder::class)
    }
}
