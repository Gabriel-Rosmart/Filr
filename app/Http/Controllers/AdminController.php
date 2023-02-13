<?php

namespace App\Http\Controllers;

use App\Models\DateRange;
use App\Models\Incidence;
use App\Models\User;
use App\Models\Schedule;
use Inertia\Inertia;
use App\Models\Permit;
use App\Rules\EvenArray;
use App\Rules\IsTimeString;
use App\Rules\IsValidDNI;
use App\Rules\IsValidPhoneNumber;
use App\Rules\TimeDoNotOverlap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
        ->when(request()->input('date') ?? false, function($query, $date){
            $query->when(request()->input('incidence') ?? false, function($query, $subject) use($date) {
                $query->whereHas('incidences', function($query) use ($subject, $date){
                    $query->where(function($query) use ($subject, $date){
                        $query->where('subject', $subject)->where('date', $date);
                    });
                });
            })
            ->with('files', function($query) use ($date) {
                $query->where('date', $date);
            })
            ->with('incidences', function($query) use ($date) {
                $query->where('date', $date);
            })
            ->whereHas('ranges', function($query) use ($date){
                $query->where(function($query) use ($date) {
                    $query->whereRaw("'$date' between `start_date` and `end_date`");
                })
                ->whereHas('schedule', function($query) use ($date) {
                    $query->whereRaw("dayname('$date') = `schedules`.`day`");
                });
            });
        }, function($query){
            $query->when(request()->input('incidence') ?? false, function($query, $subject) {
                $query->whereHas('incidences', function($query) use ($subject){
                    $query->where(function($query) use ($subject){
                        $query->where('subject', $subject)->where('date', DB::raw('CURDATE()'));
                    });
                });
            })
            ->with(['files' => function($query){
                $query->where('date', DB::raw('CURDATE()'))->orderBy('timestamp');
            },
            'incidences' => function($query){
                $query->where('date', DB::raw('CURDATE()'));
            }])
            ->where('active', DB::raw('true'))
            ->whereHas('ranges', function($query){
                $query->where(function($query){
                    $query->whereRaw("curdate() between `start_date` and `end_date`");
                })
                ->whereHas('schedule', function($query){
                    $query->whereRaw("dayname(curdate()) = `schedules`.`day`");
                });
            });
        })
        ->paginate(30)
        ->withQueryString();

        return Inertia::render('Admin/Dashboard', [
            'users' => $users,
            'filters' => request()->only('search', 'type', 'incidence', 'date')
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
            'incidences' => Incidence::withWhereHas('user', function($query){
                $query->select('id', 'name')->filter(request(['search']));
            })
            ->when(request()->input('subject') ?? false, function($query, $subject){
                $query->where('subject', $subject);
            })
            ->when(request()->input('date') ?? false, function($query, $date){
                $query->where('date', $date);
            })
            ->orderBy('date', 'desc')
            ->paginate(20)
            ->withQueryString(),
            'filters' => request()->only('search', 'subject', 'date')
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
            ->join('date_ranges', 'date_range_user.date_range_id', '=', 'date_ranges.id')
            ->where('date_ranges.start_date', '<=', DB::raw('curdate()'))
            ->where('date_ranges.end_date', '>=', DB::raw('curdate()'))
            ->join('users', 'date_range_user.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->orderBy('starts_at', 'asc')
            ->get();

            $user = User::
            select('name', 'email', 'dni', 'phone','active','profile_pic', 'id', 'role_id')
            ->with(['role' => function($query){
                $query->select('id', 'role_name');
            }])
            ->where('id', $id)
            ->get()
            ->first();
            
            return Inertia::render('Admin/UserDetails', [
                'user' => $user,
                'timetable' => $timetable,
                'incidences' => $user->incidences
            ]);
        }
        else
            return redirect('/admin');
    }

    public function edit(){
        //SELECT day, starts_at, ends_at, schedules.date_range_id FROM schedules INNER JOIN date_range_user ON schedules.date_range_id = date_range_user.date_range_id;
        $id = request()->input('id');
        if (!empty($id))
        {
            $timetable = Schedule::select('day', 'starts_at', 'ends_at', 'schedules.date_range_id', 'start_date', 'end_date')
            ->join('date_range_user', 'date_range_user.date_range_id', '=', 'schedules.date_range_id')
            ->join('date_ranges', 'date_range_user.date_range_id', '=', 'date_ranges.id')
            ->where('date_ranges.start_date', '<=', DB::raw('curdate()'))
            ->where('date_ranges.end_date', '>=', DB::raw('curdate()'))
            ->join('users', 'date_range_user.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->orderBy('day', 'asc')
            ->get();

            $user = User::
            select('id', 'name', 'dni', 'role_id', 'email', 'active', 'profile_pic')
            ->where('id', $id)
            ->get()
            ->first();
            
            return Inertia::render('Admin/EditUsers', [
                'user' => $user,
                'timetable' => $timetable
            ]);
        }
        else
            return redirect('/admin');
    }

    public function getUserName()
    {
        return Inertia::render('Admin/Register', [
            $id = request()->input('id'),
            'users' => User::
            select('name', 'id')
            ->get()
        ]);
    }

    public function registerNewUser()
    {
        return Inertia::render('Admin/RegisterUser');
    }

    public function saveRegisteredUser(Request $request)
    {
        // * Validate request data

        $evenArray = new EvenArray();
        $isTimeString = new IsTimeString();
        $timeDoNotOverlap = new TimeDoNotOverlap();

        
        $validated = $request->validate([
            'name' => ['required'],
            'dni' => ['required', new IsValidDNI],
            'email' => ['required', 'email', 'unique:users'],
            'telephone' => ['required', new IsValidPhoneNumber],
            'dates.start' => ['required', 'date'],
            'dates.end' => ['required', 'date'],
            'schedules.monday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            'schedules.tuesday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            'schedules.wednesday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            'schedules.thursday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            'schedules.friday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
        ]);

        // * Generate random password

        $fakepw = fake()->password();
        $pwcryp = bcrypt($fakepw);

        // * Create user and its relations

        DB::transaction(function () use($validated, $pwcryp) {
            $user = User::create([
                'name' => $validated['name'],
                'dni' => $validated['dni'],
                'email' => $validated['email'],
                'phone' => $validated['telephone'],
                'role_id' => 1,
                'password' => $pwcryp
            ]);
    
            $date = DateRange::create([
                'start_date' => $validated['dates']['start'],
                'end_date' => $validated['dates']['end']
            ]);

            DB::table('date_range_user')->insert([
                'user_id' => $user->id,
                'date_range_id' => $date->id
            ]);

            foreach($validated['schedules'] as $day => $times){
                if($this->notFullOfNulls($times)){
                    $numberOfNotNulls = $this->numberOfNotNulls($times);
                    if($numberOfNotNulls == 2) {
                        Schedule::insert([
                            'date_range_id' => $date->id,
                            'day' => $day,
                            'starts_at' => $times[0],
                            'ends_at' => $times[1]
                        ]);
                    }
                    if($numberOfNotNulls == 4) {
                        Schedule::insert([
                            'date_range_id' => $date->id,
                            'day' => $day,
                            'starts_at' => $times[0],
                            'ends_at' => $times[1]
                        ]);
                        Schedule::insert([
                            'date_range_id' => $date->id,
                            'day' => $day,
                            'starts_at' => $times[2],
                            'ends_at' => $times[3]
                        ]);
                    }
                }
            }
        });

        return redirect('/admin/manage');
    }

    private function notFullOfNulls($array){
        foreach($array as $elem){
            if(!is_null($elem)) return true;
        }
        return false;
    }

    private function numberOfNotNulls($array){
        $total = 0;
        foreach($array as $elem){
            if(!is_null($elem)) $total++;
        }
        return $total;
    }

}
