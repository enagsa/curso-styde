<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	if(request()->has('empty')){
    		$users = [];
    	}else{
	    	$users = [ 
	    		'Nombre 1', 'Nombre 2', 'Nombre 3', 'Nombre 4' 
	    	];
	    }

    	$title = 'Listado de usuarios';

    	return view('users.index', compact('title', 'users'));
    }

    public function edit($id){
    	return view('users.show', compact('id'));
    }

    public function create(){
    	return view('users.new');
    }
}
