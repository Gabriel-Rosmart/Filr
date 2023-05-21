<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Permit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\permitReqAdmin;
use App\Mail\permitReqUser;
use App\Rules\IsValidDNI;
use App\Rules\IsValidPhoneNumber;
use App\Rules\IsValidPic;
use App\Models\File;
use App\Models\Role;
use Dompdf\Dompdf;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Displays the identified user information,
     * timetables, incidences and permits are selected from the database
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $timetable = DB::table('schedules as s')
            ->select('day', 'starts_at', 'ends_at')
            ->join('date_ranges as ranges', 's.date_range_id', '=', 'ranges.id')
            ->join('date_range_user as u_ranges', 'ranges.id', '=', 'u_ranges.id')
            ->join('users as u', 'u_ranges.user_id', '=', 'u.id')
            ->where('u.id', $user->id)
            ->where('ranges.start_date', '<=', DB::raw('curdate()'))
            ->where('ranges.end_date', '>=', DB::raw('curdate()'))
            //->orderBy('starts_at', 'asc')
            ->get();

        $files = File::Where('user_id',$user->id, function ($query) {
            $query->select('id')->filter(request(['search']));
        })
            ->when(request()->input('date') ?? false, function($query, $date){
                $query->where('date', $date);
            })
            ->orderBy('date', 'desc')
            ->orderBy('timestamp', 'desc')
            ->paginate(8)
            ->withPath('/user?component=1');
            //->withQueryString();
            
        
        $filter = request()->only('date');
        //dd($files);
/*
        $files = File::where('user_id', $user->id)
        ->orderBy('date', 'desc')
            ->orderBy('timestamp', 'desc')
            ->paginate(8)
            ->withQueryString();
*/
        if (isset($_GET['component'])) {
            $component = (int)$_GET['component'];
        } else {
            $component = null;
        }

        //dd($component);
        return Inertia::render('User/Dashboard', [
            'user' => $user,
            'timetable' => $timetable,
            'permits' => $user->permits,
            'incidents' => $user->incidences,
            'files' => $files,
            'componentIndex' => $component,
            'filter' => $filter
        ]);
    }
    /**
     * Renders Form page to edit the user's personal data
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit()
    {
        return Inertia::render('User/Edit', [
            'user' => Auth::user(),
            'isAdmin' => Auth::user()->is_admin
        ]);
    }

    /**
     * Verifies the edit user form.
     * if the verifying process is completed succesfully, uploads data to the datababase
     *
     * @param   \Illuminate\Http\Request  $request  Form data    
     *
     * @return  void    Reloads current page
     */
    public function update(Request $request)
    {

        $validated = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'dni' => ['required', new IsValidDNI],
            'email' => ['required', 'email'],
            'telephone' => ['required', new IsValidPhoneNumber],
            'pic' => ['nullable', new IsValidPic],
            'password' => ['nullable', 'confirmed'],
        ]);

        $uploadPic = '';

        if ($validated['pic'] != null) {
            $uploadPic = $request->file('pic')[0]->storePublicly('public');
            $uploadPic = explode('/', $uploadPic)[1];
        } else {
            $uploadPic = Auth::user()->profile_pic;
        }


        if ($validated['password'] != null) {
            $uploadPass = bcrypt($validated['password']);
        } else {
            $uploadPass = Auth::user()->password;
        }

        DB::transaction(function () use ($validated, $uploadPic, $uploadPass) {
            DB::table('users')
                ->where('id',  $validated['id'])
                ->update([
                    'name' => $validated['name'],
                    'dni' => $validated['dni'],
                    'email' => $validated['email'],
                    'phone' => $validated['telephone'],
                    'profile_pic' => $uploadPic,
                    'password' => $uploadPass
                ]);
        });


        return redirect()->back();
    }

    /**
     * Render permit request page
     *
     * @return \Illuminate\Http\Response
     */
    public function permitRequest()
    {
        return Inertia::render('User/PermitRequest', ['isAdmin' => Auth::user()->is_admin]);
    }

    public function permitDetails()
    {
        $uuid = request()->input('uuid');
        $permit = Permit::where('uuid', $uuid)->first();

        if ($permit == null) {
            return redirect('/user');
        }

        return Inertia::render('User/PermitDetails', ['isAdmin' => Auth::user()->is_admin, 'permit' => $permit]);
    }

    public function permitUpdate(Request $request)
    {
        $validated = $request->validate([
            'permit' => ['required'],
            'file' => ['required', 'file', 'mimes:pdf,jpeg,png,jpg'],
        ]);

        // dd($validated);

        $request->file('file')->storeAs('justifications/' . $validated['permit']['user_id'] . '/', 'justificante-' . $validated['permit']['uuid'] . '.' . $validated['file']->getClientOriginalExtension());
        DB::table('permits')->where('uuid', $validated['permit']['uuid'])->update(['file' => 'justificante-' . $validated['permit']['uuid'] . '.' . $validated['file']->getClientOriginalExtension()]);
    }

    /**
     * Verifies permit request form.
     * If the uploaded data satisfies the requirements, uploads data to database,
     * stores attached documentation and sensd emails to the requesting user and admin
     *
     * @param   \Illuminate\Http\Request  $request  Form information
     *
     * @return  void             Redirects to user main page
     */
    public function permitSend(Request $request)
    {
        //form validation
        if ($validated = $request->validate([
            'nDays' => ['required'],
            'day' => ['required'],
            'type' => ['required'],
            'doctype' => ['required'],
        ])) {
            if ($request->nDays == 'm')
            {

                $valiDATEd = $request->validate([
                    'dayOut' => ['required'],
                ]);
                $dayOut = $valiDATEd['dayOut'];
                $hStart = '00:00';
                $hEnd = '00:00';
            }
            else
            {
                $valiDATEd = $request->validate([
                    'hStart' => ['required'],
                    'hEnd' => ['required']
                ]);
                $dayOut = $validated['day'];
                $hStart = $valiDATEd['hStart'];
                $hEnd = $valiDATEd['hEnd'];
            }
        }

        //db insertion
        $uuid = fake()->uuid();
        $file = null;
        $filename = "";
        if ($request->file('file') != null)
        {
            $filename = 'justificante-' . $uuid . '.' .$request->file('file')->getClientOriginalExtension();
            $file = $request->file('file');
            $file->storeAs('justifications/' . Auth::user()->id, $filename);
        }
        DB::transaction(function () use ($uuid, $validated, $dayOut, $hStart, $hEnd, $filename) {
            DB::table('permits')->insertGetId([
                'uuid' => $uuid,
                'user_id' => Auth::user()->id,
                'permitType' => $validated['type'],
                'status' => 'pending',
                'start_date' => $validated['day'],
                'end_date' => $dayOut,
                'start_time' => $hStart,
                'end_time' => $hEnd,
                'fileType' => $validated['doctype'],
                'requested_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'file' => $filename
            ]);
        });
        //dd($_SERVER);

        //pdf generation
        $fileName = self::pdfGenerate($uuid, Auth::user(), $validated['day'] ,$dayOut, $hStart, $hEnd);

        $admins = User::where('is_admin', true)->get();

        foreach ($admins as $admin)
            Mail::to($admin->email)->send(new permitReqAdmin(Auth::user(), $request->day, $uuid));

        //email sending
        //Mail::to('admin@gmail.com')->send(new permitReqAdmin(Auth::user(), $request->day, $uuid));
        Mail::to(Auth::user()->email)->send(new permitReqUser($request->day, $uuid));

        return redirect('/user?component=2');
    }

    public function justificationDownload(Request $request)
    { 
        $uuid = $request->input('uuid');
        $permit = Permit::where('uuid', $uuid)->first();

        if ($permit == null) {
            return redirect('/user');
        }

        if ($permit->file == null) {
            return redirect('/user/permmit?uuid=' . $uuid);
        }

        $type = Storage::mimeType('justifications/' . $permit->user_id . '/' . $permit->file);

        return Storage::download('justifications/' . $permit->user_id . '/' . $permit->file, $permit->file, ['Content-Type' => $type]);
    }

    public function permitDownload(Request $request)
    {
        $uuid = $request->input('uuid');
        $permit = Permit::where('uuid', $uuid)->first();

        if ($permit == null) {
            return redirect('/user');
        }

        if ($permit->file == null) {
            return redirect('/user/permmit?uuid=' . $uuid);
        }

        return Storage::download('permits/' . $permit->user_id . '/permiso_' . $uuid. '.pdf');
    }

    public function pdfGenerate(string $uuid, User $user, string $day, string $dayOut, string $hStart, string $hEnd)
    {
        $file = storage_path('permits.json');
        $json = json_decode(file_get_contents($file), true);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('permiso', [
            'uuid'          => $uuid,
            'name'          => $user->name,
            'dni'           => $user->dni,
            'phone'         => $user->phone,
            'email'         => $user->email,
            'body'          => $json[Role::find($user->role_id)->role_name],
            'date_st'       => $day,
            'date_nd'       => $dayOut,
            'entry'         => $hStart,
            'exit'          => $hEnd,
            'type'          => $json[Permit::where('uuid', $uuid)->first()->permitType],
            'documentation' => $json[Permit::where('uuid', $uuid)->first()->fileType],
        ]));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $fileName = 'permits/'. $user->id .'/permiso_'. $uuid . '.pdf';
        Storage::put($fileName, $dompdf->output());

        return $fileName;
    }
}
