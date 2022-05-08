<?php

namespace App\Http\Controllers;

use App\Contracts\Auth\UserRepository as ContractUserRepository;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected ContractUserRepository $contractUserRepository;
    public function __construct(ContractUserRepository $contractUserRepository)
    {
        $this->contractUserRepository = $contractUserRepository;
    }

    public function index(): View
    {
        $users = $this->contractUserRepository->indexRoleUser();

        return view('admin.admin')->with('users', ($users));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //
    }

    public function store(Request $request)
    {
        //Crear nuevos Registros
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user): View
    {
        return view('admin.editUser')->with('user', $user);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->contractUserRepository->update($user, $request);
        return redirect()->back()->with('result', 'Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Eliminar un registro
        $user->delete();
        return redirect(route('admin.index'))->with('result', 'Usuario Eliminado');
    }

    public function State(Request $request, User $user): RedirectResponse
    {
        $this->contractUserRepository->state($user);
        return redirect(route('admin.index'));
    }
}
