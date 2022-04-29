<?php

namespace App\Contracts\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface UserRepository
{
    public function Store(array $data): User;
    public function indexRoleUser(): Collection;
    public function update(User $user, Request $data): void;
    public function state(User $user): void;
}
