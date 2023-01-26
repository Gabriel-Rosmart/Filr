<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Pass data to the view
        return Inertia::render('Admin/Dashboard');
    }

    /**
     * Show a listing of all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request)
    {
        /*
        $users = User::query()
        ->select('id', 'name', 'email', 'active', 'role_id')
        ->when($request->input('search'), function($query, $search){
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"); 
        })
        ->when($request->input('type'), function($query, $type){
            $query->whereHas('role', function($query) use ($type){
                $query->where('role_name', '=', $type);
            });
        })
        ->with(['role' => function($query){
            $query->select('id', 'role_name');
        }])
        ->get();
        */

        $users = User::query()
        ->select('id', 'name', 'email', 'active', 'role_id')
        ->when($request->input('search'), function($query, $search){
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->when($request->input('type'), function($query, $type){
            $query->whereHas('role', function($query) use ($type){
                $query->where('role_name', '=', $type);
            });
        })
        ->with(['role' => function($query){
            $query->select('id', 'role_name');
        }])
        ->get();


        return Inertia::render('Admin/ManageUsers', [
            'users' => $users
        ]);
    }

    public function permits()
    {
        return Inertia::render('Admin/ManagePermits', [
            'permits' => Permit::with([
                'user' => function($query){
                    $query->select('id', 'name');
                }
            ])->get()
        ]);
    }

    public function details()
    {
        return Inertia::render('Admin/UserDetails');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
