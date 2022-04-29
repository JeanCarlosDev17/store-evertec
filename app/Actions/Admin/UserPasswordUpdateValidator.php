<?php

namespace App\Actions\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class UserPasswordUpdateValidator
{
    public static function validate($data)
    {
        Validator::make(
            $data->all(),
            ['newPassword' => ['confirmed', Rules\Password::defaults()]],
            [],
            ['newPassword'=>'Nueva Contraseña']
        )->validate();
    }
}
