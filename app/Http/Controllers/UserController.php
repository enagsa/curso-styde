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

    public function edit($id){
        $user = User::find($id);

    	return view('users.show', compact('user'));
    }

    public function create(){
    	return view('users.new');
    }
}
