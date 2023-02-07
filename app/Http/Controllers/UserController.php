<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Displays the main view for common users
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('User/Dashboard', ['user' => $user]);
    }
    /**
     * Displays user-associated warnings
     * @return \Illuminate\Http\Response
     */
    public function warnings()
    {


        return Inertia::render('User/Warnings');
    }
    /**
     * Displays permits and incidents associated to the user 
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        return Inertia::render('User/Stats');
    }
}
