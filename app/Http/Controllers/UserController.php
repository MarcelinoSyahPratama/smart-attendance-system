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
    public function edit(User $user){
        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
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
            'role' => $request->role,
        ]);
        return redirect()->route('users')->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8',
            'password_confirmation' => 'nullable|string|same:password',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);
        return redirect()->route('users')->with('success', 'User updated successfully.');
    }
    public function delete(User $user){
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
