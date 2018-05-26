<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

    	$title = 'Listado de usuarios';

    	return view('users.index', compact('title', 'users'));
    }

    public function show(User $user){
    	return view('users.show', compact('user'));
    }

    public function create(){
    	return view('users.new');
    }

    public function store(){
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|between:5,100',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email no es válido',
            'email.unique' => 'Email ya registrado',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.between' => 'La contraseña es demasiado corta'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users');
    }

    public function edit(User $user){
        return view('users.edit', compact('user'));
    }

    public function update(User $user){
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|between:5,100',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email no es válido',
            'email.unique' => 'Email ya registrado',
            'password.between' => 'La contraseña es demasiado corta'
        ]);

        if($data['password'] != null)
            $data['password'] = bcrypt($data['password']);
        else
            unset($data['password']);

        $user->update($data);

        return redirect()->route('users.show', compact('user'));
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('users');
    }
}
