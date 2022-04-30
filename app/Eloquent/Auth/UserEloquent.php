<?php

namespace App\Eloquent\Auth;

use App\Actions\Admin\UserPasswordUpdateValidator;
use App\Actions\User\UserPasswordHash;
use App\Contracts\Auth\UserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserEloquent implements UserRepository
{
    private User $user;
    private UserPasswordHash $userPasswordHash;
    public function __construct()
    {
        $this->user = new User();
        $this->userPasswordHash = new UserPasswordHash();
    }

    public function Store(array $data): User
    {
        $this->user->name = $data['name'];
        $this->user->email = $data['email'];
        $this->user->password = $this->userPasswordHash->generateHash($data['password']);
        $this->user->assignRole('user');
        $this->user->save();
        return $this->user;
    }

    public function indexRoleUser(): Collection
    {

        return  User::role('user')->get();
    }

    public function update(User $user, Request $data): void
    {


        if (isset($data->newPassword)) {
            UserPasswordUpdateValidator::validate($data);

            $user->password = $data->newPassword;
        }
        $user->name = $data->name;

        $user->save();
    }

    public function state(User $user): void
    {
        $user->user_state = $user->user_state == 1 ? 0 : 1;

        $user->save();
    }
}
