<?php

namespace App\Eloquent\Auth;

use App\Actions\User\UserPasswordHash;
use App\Contracts\Auth\UserRepository;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use PhpParser\Node\Expr\Array_;

class UserEloquent implements UserRepository
{
    private User $user;
    private UserPasswordHash $userPasswordHash;
    public function __construct(){
        $this->user=new User();
        $this->userPasswordHash=new UserPasswordHash();
    }

    public function Store(array  $data): User
    {
        // TODO: Implement Store() method.


        $this->user->name=$data['name'];
        $this->user->email=$data['email'];
        $this->user->password =$this->userPasswordHash->generateHash($data['password']);
        $this->user->assignRole('user');
        $this->user->save();
        return $this->user;
    }
}
