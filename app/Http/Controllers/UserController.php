<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    
    public function create()
    {
        return view('user.form');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request['name'], 
            'email' => $request['email'], 
            'password' => $request['password'], 
        ]);
        return redirect()->route('user.index')->
            with('success', ['Usuário cadastrado com sucesso!']);

    }
}