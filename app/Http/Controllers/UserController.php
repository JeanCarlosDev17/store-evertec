<?php

namespace App\Http\Controllers;

use App\Actions\Admin\UserPasswordUpdateValidator;
use App\Contracts\Auth\UserRepository as ContractUserRepository;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{


    protected ContractUserRepository $contractUserRepository;
    public function __construct(ContractUserRepository $contractUserRepository){

        $this->contractUserRepository=$contractUserRepository;
    }
    /**
     * Display a listing of the resource.
     * Mostrar todos los registros
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $users= $this->contractUserRepository->indexRoleUser(); ;
        return view('admin.admin')->with('users',($users));
//        return view('admin',compact($users));
    }


    /**
     * Show the form for creating a new resource.
     * mostrar la vista para crear mas registros
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Crear nuevos Registros
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $id)
    {
        //Consultar un registro individualmente
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user):View
    {
        //Mostrar vista para editar un registro

        return view('admin.editUser')->with('user',$user);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->contractUserRepository->update($user,$request);
//        return redirect(route('admin.index'));
        return redirect()->back()->with('result','Actualizado Correctamente');

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
        //$user=$this->getUserDB($id);
        $user->delete();
        return redirect(route('admin.index'));
    }

    /*public function getUserDB(int $id):User
    {
//            dd(User::find($id));

           return User::find($id);
    }*/

    public function State(Request $request, User $user)
    {

        $user->user_state = $user->user_state==1 ? 0 : 1;
        $user->save();
        return redirect(route('admin.index'));
    }

}
