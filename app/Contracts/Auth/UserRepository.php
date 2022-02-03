<?php

namespace App\Contracts\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    public function Store(array $data):User;
    public function indexRoleUser():Collection;
    public function update(User $user,Request $data):void;

}
