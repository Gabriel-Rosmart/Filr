<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Permit;
use Illuminate\Database\Eloquent\Model;
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
        /*  
        $users = User::select('id', 'name')
        ->filter(request(['search', 'type']))
        ->where('active', DB::raw('true'))
        ->with(['files', 'range' => function($query){
            $query->whereRaw("curdate() between `date_ranges`.`start_date` and `date_ranges`.`end_date`");
        }, 
        'range.schedule' => function($query){
            $query->whereRaw("dayname(curdate()) = `schedules`.`day`");
        }])
        ->whereHas('range', function($query){
            $query->where(function($query){
                $query->whereRaw("curdate() between `date_ranges`.`start_date` and `date_ranges`.`end_date`");
            })
            ->whereHas('schedule', function($query){
                $query->whereRaw("dayname(curdate()) = `schedules`.`day`");
            });
        })
        ->paginate(30)
        ->withQueryString();
        */

        $users = User::select('id', 'name')
        ->filter(request(['search', 'type']))
        ->where('active', DB::raw('true'))
        ->with('files')
        ->withWhereHas('ranges', function($query){
            $query->where(function($query){
                $query->whereRaw("curdate() between `start_date` and `end_date`");
            })
            ->whereHas('schedule', function($query){
                $query->whereRaw("dayname(curdate()) = `schedules`.`day`");
            });
        })
        ->with('ranges.schedule', function($query){
            $query->whereRaw("dayname(curdate()) = `schedules`.`day`");
        })
        ->paginate(30)
        ->withQueryString();

        return Inertia::render('Admin/Dashboard', [
            'users' => $users,
            'filters' => request()->only('search', 'type')
        ]);
    }

    /**
     * Show a listing of all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function listing()
    {

        return Inertia::render('Admin/ManageUsers', [
            'users' => User::query()
            ->select('id', 'name', 'email', 'active', 'role_id')
            ->filter(request(['search', 'active', 'type']))
            ->with(['role' => function($query){
                $query->select('id', 'role_name');
            }])
            ->paginate(15)
            ->withQueryString(),
            'filters' => request()->only('search', 'type', 'active')
        ]);
    }

    public function permits()
    {
        return Inertia::render('Admin/ManagePermits', [
            'permits' => Permit::with([
                'user' => function($query){
                    $query->select('id', 'name');
                }
            ])
            ->when(request()->input('status') ?? false, function($query, $status){
                $query->where('status', $status);
            })
            ->whereHas('user', function($query){
                $query->when(request('search'), function($query, $search){
                    $query->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('requested_at', 'desc')
            ->paginate(20)
            ->withQueryString(),
            'filters' => request()->only('search', 'status')
        ]);
    }

    public function details()
    {
        return Inertia::render('Admin/UserDetails', [
            'user' => User::query()
            ->select('name', 'email', 'active')
            ->where('id', 1)
        ]);
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
