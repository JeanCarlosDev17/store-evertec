<?php

namespace App\Repositories;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Actions\User\UserPasswordHash;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private User $userModel;
    private UserPasswordHash $userPasswordHash;
    public function __construct(){
        $this->userModel=new User();
        $this->userPasswordHash=new UserPasswordHash();
    }

    public function create(UserStoreRequest $request):User {
//        dump("hola desde el repository");
        $this->userModel->name=$request->name;
        $this->userModel->email=$request->email;
        $this->userModel->password =$this->userPasswordHash->generateHash($request->password);
        $this->userModel->assignRole('user');
        $this->userModel->save();
        return $this->userModel;
    }
}
