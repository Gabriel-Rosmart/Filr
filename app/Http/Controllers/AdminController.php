<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Permit;
use App\Helpers\Helper;
use App\Models\Schedule;
use App\Rules\EvenArray;
use App\Models\DateRange;
use App\Models\Incidence;
use App\Rules\IsValidDNI;
use App\Rules\IsTimeString;
use App\Mail\AccountCreated;
use App\Rules\DatesDontOverlap;
use Illuminate\Http\Request;
use App\Rules\TimeDoNotOverlap;
use App\Rules\IsValidPhoneNumber;
use App\Rules\RangesDontOverlap;
use Dompdf\Dompdf;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Get all users along with their files
     * This function apply a lot of filters so the query to the
     * database is complex
     *
     * @return \Illuminate\Http\Response
     */
    public function listAllActiveUsersFiles()
    {

        $users = User::select('id', 'name')
            ->filter(request(['search', 'type']))
            ->when(request()->input('date') ?? false, function ($query, $date) {
                $query->when(request()->input('incidence') ?? false, function ($query, $subject) use ($date) {
                    $query->whereHas('incidences', function ($query) use ($subject, $date) {
                        $query->where(function ($query) use ($subject, $date) {
                            $query->where('subject', $subject)->where('date', $date);
                        });
                    });
                })
                    ->with('files', function ($query) use ($date) {
                        $query->where('date', $date);
                    })
                    ->with('incidences', function ($query) use ($date) {
                        $query->where('date', $date);
                    })
                    ->whereHas('ranges', function ($query) use ($date) {
                        $query->where(function ($query) use ($date) {
                            $query->whereRaw("'$date' between `start_date` and `end_date`");
                        })
                            ->whereHas('schedule', function ($query) use ($date) {
                                $query->whereRaw("dayname('$date') = `schedules`.`day`");
                            });
                    });
            }, function ($query) {
                $query->when(request()->input('incidence') ?? false, function ($query, $subject) {
                    $query->whereHas('incidences', function ($query) use ($subject) {
                        $query->where(function ($query) use ($subject) {
                            $query->where('subject', $subject)->where('date', DB::raw('CURDATE()'));
                        });
                    });
                })
                    ->with([
                        'files' => function ($query) {
                            $query->where('date', DB::raw('CURDATE()'))->orderBy('timestamp');
                        },
                        'incidences' => function ($query) {
                            $query->where('date', DB::raw('CURDATE()'));
                        }
                    ])
                    ->where('active', DB::raw('true'))
                    ->whereHas('ranges', function ($query) {
                        $query->where(function ($query) {
                            $query->whereRaw("curdate() between `start_date` and `end_date`");
                        })
                            ->whereHas('schedule', function ($query) {
                                $query->whereRaw("dayname(curdate()) = `schedules`.`day`");
                            });
                    });
            })
            ->paginate(30)
            ->withQueryString();

        return Inertia::render('Admin/Dashboard', [
            'users' => $users,
            'filters' => request()->only('search', 'type', 'incidence', 'date'),
            'roles' => Role::all()
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
                ->when(request()->input('searchId') ?? false, function ($query, $id) {
                    $query->where('id', $id);
                })
                ->with(['role' => function ($query) {
                    $query->select('id', 'role_name');
                }])
                ->paginate(15)
                ->withQueryString(),
            'filters' => request()->only('search', 'type', 'active', 'searchId'),
            'roles' => Role::all()
        ]);
    }

    /**
     * Show a listing of all permits
     *
     * @return \Illuminate\Http\Response
     */

    public function listAllPermits()
    {
        return Inertia::render('Admin/ManagePermits', [
            'permits' => Permit::with([
                'user' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
                ->when(request()->input('status') ?? false, function ($query, $status) {
                    $query->where('status', $status);
                })
                ->whereHas('user', function ($query) {
                    $query->when(request('search'), function ($query, $search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
                })
                ->orderBy('requested_at', 'desc')
                ->paginate(20)
                ->withQueryString(),
            'filters' => request()->only('search', 'status')
        ]);
    }

    /**
     * List all incidences
     *
     * @return \Illuminate\Http\Response
     */

    public function listAllIncidences()
    {
        return Inertia::render('Admin/Incidences', [
            'incidences' => Incidence::withWhereHas('user', function ($query) {
                $query->select('id', 'name')->filter(request(['search']));
            })
                ->when(request()->input('subject') ?? false, function ($query, $subject) {
                    $query->where('subject', $subject);
                })
                ->when(request()->input('date') ?? false, function ($query, $date) {
                    $query->where('date', $date);
                })
                ->orderBy('date', 'desc')
                ->paginate(20)
                ->withQueryString(),
            'filters' => request()->only('search', 'subject', 'date')
        ]);
    }

    /**
     * Gets the user's details
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserDetails()
    {
        //SELECT day, starts_at, ends_at, schedules.date_range_id FROM schedules INNER JOIN date_range_user ON schedules.date_range_id = date_range_user.date_range_id;
        $id = request()->input('id');
        if (!empty($id)) {
            $timetable = Schedule::select('day', 'starts_at', 'ends_at', 'schedules.date_range_id')
                ->join('date_range_user', 'date_range_user.date_range_id', '=', 'schedules.date_range_id')
                ->join('date_ranges', 'date_range_user.date_range_id', '=', 'date_ranges.id')
                ->where('date_ranges.start_date', '<=', DB::raw('curdate()'))
                ->where('date_ranges.end_date', '>=', DB::raw('curdate()'))
                ->join('users', 'date_range_user.user_id', '=', 'users.id')
                ->where('users.id', $id)
                ->orderBy('starts_at', 'asc')
                ->get();
           
            $user = User::select('name', 'email', 'dni', 'phone', 'active', 'profile_pic', 'id', 'role_id')     
            ->with(['role' => function ($query) {
                    $query->select('id', 'role_name');
                }])
                ->where('id', $id)
                ->get()
                ->first();

                $files = File::Where('user_id', $id)
                    ->when(request()->input('date') ?? false, function($query, $date){
                        $query->where('date',$date);
                    })                      
                    ->when(request()->input('month') ?? false, function($query, $month){
                        $query->whereMonth('date' , $month);
                    })        
                    ->orderBy('date', 'desc')
                    ->orderBy('timestamp', 'asc')
                    ->paginate(20)
                    ->withQueryString();

                $filter = request()->only('date','month');

            return Inertia::render('Admin/UserDetails', [
                'user' => $user,
                'timetable' => $timetable,
                'incidences' => $user->incidences,
                'permits' => $user->permits,
                'files' => $files,
                'filter' => $filter
            ]);
        } else
            return redirect('/admin');
    }

    /**
     * Gets the user's data and schedule for Editusers
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //SELECT day, starts_at, ends_at, schedules.date_range_id FROM schedules INNER JOIN date_range_user ON schedules.date_range_id = date_range_user.date_range_id;
        $id = request()->input('id');
        $range = request()->input('range');
        if (!empty($id)) {
            $timetable = Schedule::select('day', 'starts_at', 'ends_at', 'schedules.date_range_id')
                ->join('date_range_user', 'date_range_user.date_range_id', '=', 'schedules.date_range_id')
                ->where('user_id', $id)
                ->orderBy('starts_at', 'asc')
                ->orderBy('day', 'asc')
                ->get();

            $user = User::select('id', 'name', 'dni', 'phone', 'role_id', 'email', 'active', 'profile_pic')
                ->where('id', $id)
                ->get()
                ->first();

            $dates = DateRange::select('date_range_user.id', 'start_date', 'end_date')
                ->join('date_range_user', 'date_range_user.date_range_id', '=', 'date_ranges.id')
                ->where('date_range_user.user_id', $id)
                ->orderBy('start_date', 'asc')
                ->get();

            return Inertia::render('Admin/EditUsers', [
                'user' => $user,
                'timetable' => $timetable,
                'dates' => $dates,
                'isAdmin' => Auth::user()->is_admin,
                'range' => $range
            ]);
        } else
            return redirect('/admin');
    }

    /**
     *  Render the view for registering a user
     *
     * @return \Illuminate\Http\Response
     */

    public function registerNewUser()
    {
        return Inertia::render('Admin/RegisterUser', [
            'users' => User::select('id', 'name')->orderBy('name')->get(),

            'roles' => Role::select('role_name', 'id')
                ->get()
        ]);
    }

    /**
     * Process a user registration
     * Send an email to the user after registration is complete
     *
     * @return \Illuminate\Http\Response
     */

    public function saveRegisteredUser(Request $request)
    {
        // * Validate request data

        $evenArray = new EvenArray();
        $isTimeString = new IsTimeString();
        $timeDoNotOverlap = new TimeDoNotOverlap();


        $validated = $request->validate(
            [
                'name' => ['required'],
                'dni' => ['required', new IsValidDNI],
                'email' => ['required', 'email', 'unique:users'],
                'telephone' => ['required', new IsValidPhoneNumber],
                'admin' => ['boolean'],
                'role' => ['nullable', Rule::requiredIf(!$request->input('substitute.is'))],
                'substitute.is' => ['boolean'],
                'substitute.name' => ['nullable'],
                'dates.start' => ['nullable', 'date', Rule::requiredIf(!$request->input('substitute.is'))],
                'dates.end' => ['nullable', 'date', Rule::requiredIf(!$request->input('substitute.is'))],
                'schedules.monday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
                'schedules.tuesday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
                'schedules.wednesday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
                'schedules.thursday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
                'schedules.friday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            ],
            [
                'name.required' => trans('rules.name_req'),
                'dni.required' => trans('rules.dni_req'),
                'email.required' => trans('rules.email_req'),
                'telephone.required' => trans('rules.phone_req'),
                'role.required' => trans('rules.role_req'),
                'dates.start.required' => trans('rules.start_req'),
                'dates.end.required' => trans('rules.end_req')
            ]
        );


        // * Generate random password

        $fakepw = fake()->password();
        $pwcryp = bcrypt($fakepw);

        // * Create user and its relations

        Helper::saveUserCompleteRecord($validated, $pwcryp);

        // * Send mail to user

        Mail::to($validated['email'])->send(new AccountCreated($validated['name'], $fakepw));

        return redirect('/admin/manage');
    }

    /**
     * Process a user update
     *
     * @return \Illuminate\Http\Response
     */

    public function updateUser(Request $request)
    {
        $evenArray = new EvenArray();
        $isTimeString = new IsTimeString();
        $timeDoNotOverlap = new TimeDoNotOverlap(); 
        $validated = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'dni' => ['required', new IsValidDNI],
            'email' => ['required', 'email'],
            'telephone' => ['required', new IsValidPhoneNumber],
            'schedules' => ['nullable'],
            'schedules' => ['nullable'],
            'schedules_id' => ['nullable'],
            'schedules.monday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            'schedules.tuesday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            'schedules.wednesday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            'schedules.thursday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
            'schedules.friday' => [$evenArray, $isTimeString, $timeDoNotOverlap],
        ],
        [
            'name.required' => trans('rules.name_req'),
            'dni.required' => trans('rules.dni_req'),
            'email.required' => trans('rules.email_req'),
            'telephone.required' => trans('rules.phone_req'),
            'role.required' => trans('rules.role_req'),
        ]);

        $user = User::select('users.id', 'name', 'dni', 'role_id', 'email', 'active', 'profile_pic', 'date_range_id', 'phone')
            ->where('users.id', $validated['id'])
            ->join('date_range_user', 'date_range_user.user_id', '=', 'users.id')
            ->get()
            ->first();

        Helper::updateUserCompleteRecord($validated, $user);

        return redirect('/admin/edit?id=' . $validated['id']);
    }

    public function getDates()
    {
        $id = request()->input('id');
        if (!empty($id)) {
            $dates = DateRange::select('date_range_user.id', 'date_range_user.date_range_id', 'start_date', 'end_date')
                ->join('date_range_user', 'date_range_user.date_range_id', '=', 'date_ranges.id')
                ->where('date_range_user.user_id', $id)
                ->orderBy('start_date', 'asc')
                ->get();
            $user = User::select('id', 'name', 'dni', 'phone', 'role_id', 'email', 'active', 'profile_pic')
                ->where('id', $id)
                ->get()
                ->first();
            return Inertia::render('Admin/AddDateRange', [
                'dates' => $dates,
                'user' => $user,
                'isAdmin' => Auth::user()->is_admin
            ]);
        } else {
            return redirect('/admin');
        }
    }

    public function addDateRange(Request $request)
    {
        $datesDontOverlap = new DatesDontOverlap();
        $rangesDontOverlap = new RangesDontOverlap($request->user_id, $request->id);

        $validated = $request->validate(
            [
                'id' => ['nullable'],
                'user_id' => ['required'],
                'dates' => ['required', $datesDontOverlap, $rangesDontOverlap],
            ],
            [
                'dates.required' => trans('dates_req')
            ]
        );

        $user = User::select('users.id', 'date_range_id')
            ->where('users.id', $validated['user_id'])
            ->join('date_range_user', 'date_range_user.user_id', '=', 'users.id')
            ->get()
            ->first();

        Helper::updateUserDates($validated, $user);

        return redirect('/admin/dates?id=' . $user->id);
    }

    public function generateReport(Request $request)
    {
            
            $UserData = User::select('*')
            ->when($request->day ?? $request->month ?? $request->year ?? false, function($query, $date){
            $query->with([
                'files' => function($query) use ($date){
                    $query->when(strlen($date) == 10, function($query) use ($date){
                        $query->where('date', $date);
                    })
                    ->when(strlen($date) == 2, function($query) use ($date){
                        $query->whereMonth('date', $date);
                    })
                    ->when(strlen($date) == 4, function($query) use ($date){
                        $query->whereYear('date', $date);
                    })  
                    ->orderBy('date', 'asc')  
                    ->orderBy('timestamp', 'asc');                   
                },
                'incidences' => function($query) use ($date){
                    $query->when(strlen($date) == 10, function($query) use ($date){
                        $query->where('date', $date);
                    })
                    ->when(strlen($date) == 2, function($query) use ($date){
                        $query->whereMonth('date', $date);
                    })
                    ->when(strlen($date) == 4, function($query) use ($date){
                        $query->whereYear('date', $date);
                    })
                    ->orderBy('date', 'asc');                       
                },
                'role'
            ]);
        }, function($query){
            $query->with(['files','incidences','role']);
        })
        ->where('id', request()->input('user_id'))
        ->get();
        //return $UserData;
        //Log::channel('daily')->info('INFO; User with id ' . $request->user_id . ' found: ' . $UserData->name);
        
        $range = DB::table('date_ranges', 'r')
        ->select('r.start_date', 'r.end_date')
        ->join('date_range_user as r_u', 'r.id', '=', 'r_u.date_range_id')
        ->where('r_u.user_id', $request->user_id)
        ->when($request->day ?? $request->month ?? $request->year ?? false, function($query,$date){
            $query->when(strlen($date) == 10, function($query) use ($date){
                $query->where("r.start_date", '<=', $date)
                    ->where('r.end_date', '>=', $date);
            })
            ->when(strlen($date) == 2, function($query) use ($date){
                $query->where(DB::raw('MONTH(r.start_date)'), '<=', $date)
                ->where(DB::raw('MONTH(end_date)'), '>=', $date);
            })
            ->when(strlen($date) == 4, function($query) use ($date){
                $query->where(DB::raw('YEAR(r.start_date)'), '<=', $date)
                ->where(DB::raw('YEAR(r.end_date)'), '>=', $date);
            });
        }, function($query){
            $query->where('r.start_date', '<', DB::raw('CURDATE()'));
        })
        ->get();
        $pdf = new Dompdf();
        $pdf->loadHtml(view('fileReport',[
            'user' => $UserData[0],
            'range' => $range,
            'period' => $request->day ?? $request->month ?? $request->year
        ]));
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $fileName = DIRECTORY_SEPARATOR.'reports'. DIRECTORY_SEPARATOR . date('Ymd').'__'. $UserData[0]->id . '.pdf';
        Storage::put($fileName, $pdf->output());
        return $fileName;
    }

    public function downloadReport(Request $request){      
        $headers = ['Content-Type: application/pdf'];
        return Storage::download($request->query('path'), 'test.pdf', $headers);
    }

    public function deleteReport(Request $request){
        return Storage::delete($request->query('path'));
    }


         
}
