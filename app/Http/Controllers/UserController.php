<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $Users = User::all();
        return Inertia::render('Users/Index', [
            'users' => $Users
        ]);
    }
}
