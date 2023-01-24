<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Displays the main view for common users
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Dashboard');
    }
}
