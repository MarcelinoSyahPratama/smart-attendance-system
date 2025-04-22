<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $Users = User::paginate(10);
        return Inertia::render('Users/Index', [
            'users' => $Users
        ]);
    }

    public function create(){
        return Inertia::render('Users/Create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('users')->with('success', 'User created successfully.');
    }
}
