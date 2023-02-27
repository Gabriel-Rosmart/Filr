<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $user_id = request()->input('timestamp');
        $now = Carbon::now();
        return redirect()->back();
    }
}