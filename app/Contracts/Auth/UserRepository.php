<?php

namespace App\Contracts\Auth;

use App\Actions\User\UserPasswordHash;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;

interface UserRepository
{
    public function Store(array $data):User;

}
