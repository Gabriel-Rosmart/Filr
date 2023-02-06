<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use App\Models\User;
use App\Models\Schedule;
use Inertia\Inertia;
use App\Models\Permit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAllActiveUsersFiles()
    {   

        $users = User::select('id', 'name')
        ->filter(request(['search', 'type']))
        ->where('active', DB::raw('true'))
        ->with('files', function($query){
            $query->where('date', DB::raw('CURDATE()'));
        })
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
    public function listAllUsers()
    {

        return Inertia::render('Admin/ManageUsers', [
            'users' => User::query()
            ->select('id', 'name', 'email', 'active', 'role_id', 'profile_pic')
            ->filter(request(['search', 'active', 'type']))
            ->with(['role' => function($query){
                $query->select('id', 'role_name');
            }])
            ->paginate(15)
            ->withQueryString(),
            'filters' => request()->only('search', 'type', 'active')
        ]);
    }

    public function listAllPermits()
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

    public function listAllIncidences()
    {
        return Inertia::render('Admin/Incidences', [
            'incidences' => Incidence::with(['user' => function($query){
                $query->select('id', 'name');
            }])->get()
        ]);
    }

    public function getUserDetails()
    {
        //SELECT day, starts_at, ends_at, schedules.date_range_id FROM schedules INNER JOIN date_range_user ON schedules.date_range_id = date_range_user.date_range_id;
        $id = request()->input('id');
        if (!empty($id))
        {
            $timetable = Schedule::select('day', 'starts_at', 'ends_at', 'schedules.date_range_id')
            ->join('date_range_user', 'date_range_user.date_range_id', '=', 'schedules.date_range_id')
            ->join('users', 'date_range_user.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->get();
            return Inertia::render('Admin/UserDetails', [
                'user' => User::
                select('name', 'email', 'active', 'profile_pic')
                ->where('id', $id)
                ->get(),
                'timetable' => $timetable
            ]);
        }
        else
            return redirect('/admin');
    }

    public function edit(){
        return Inertia::render('Admin/EditUsers', [
            $id = request()->input('id'),
            'user' => User::
            select('name', 'email', 'active', 'profile_pic')
            ->where('id', $id)
            ->get()
        ]);
    }

}
