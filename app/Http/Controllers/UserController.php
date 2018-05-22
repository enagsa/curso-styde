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
            'name' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users');
    }
}
