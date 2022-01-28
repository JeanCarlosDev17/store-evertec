<?php

namespace App\User;

use Illuminate\Support\Facades\Hash;

class UserPasswordHash
{
    public function generateHash(string $password):string{
        return Hash::make($password);
    }
}
