<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Actions\User\UserPasswordHash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userAdmin= new User();
        $userAdmin->name="jean Admin";
        $userAdmin->email="jeancarlosrecio@hotmail.com";
        $userAdmin->password=(new UserPasswordHash)->generateHash("123456789");
        $userAdmin->remember_token =Str::random(10);
        $userAdmin->email_verified_at= Carbon::now()->toDateTimeString();
        $userAdmin->assignRole('admin');
        $userAdmin->save();

        $userRegular= new User();
        $userRegular->name="jean UserTest";
        $userRegular->email="jean@mail.com";
        $userRegular->password=(new UserPasswordHash)->generateHash("123456789");
        $userRegular->remember_token =Str::random(10);
        $userRegular->email_verified_at= Carbon::now()->toDateTimeString();
        $userRegular->assignRole('user');
        $userRegular->save();
    }
}
