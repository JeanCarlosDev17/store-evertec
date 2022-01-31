<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\UserPasswordHash;
use App\Eloquent\Auth\UserEloquent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\UserController;
use App\Contracts\Auth\UserRepository as ContractUserRepository;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    private UserRepository $userRepository;
    private ContractUserRepository $contractUserRepository;
    public function __construct(UserRepository $userRepository,ContractUserRepository $contractUserRepository){
        $this->userRepository=$userRepository;
        $this->contractUserRepository=$contractUserRepository;
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create():View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserStoreRequest $request):RedirectResponse
    {

        $user= $this->contractUserRepository->Store($request->all());
        event(new Registered($user));
        Auth::login($user);
        //Posterior a la creacion del usuario y el login redirigir a la home de usuarios
        return redirect(RouteServiceProvider::HOME);
    }
}
