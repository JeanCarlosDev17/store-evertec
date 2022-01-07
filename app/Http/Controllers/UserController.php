<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Mostrar todos los registros
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $users= User::all(['id','name','email','role_id','user_state']);


        return view('admin')->with('users',($users));
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
    public function show($id)
    {
        //Consultar un registro individualmente
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id):View
    {
        //Mostrar vista para editar un registro

        $user=$this->getUserDB($id);

        return view('user.edit')->with('user',$user);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user=$this->getUserDB($id);

        $user->name=$request->name;
        $user->email=$request->email;

        $user->save();
        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminar un registro
        $user=$this->getUserDB($id);
        $user->delete();
        return redirect(route('admin.index'));
    }

    public function getUserDB(int $id):User
    {
//            dd(User::find($id));

           return User::find($id);
    }
}
