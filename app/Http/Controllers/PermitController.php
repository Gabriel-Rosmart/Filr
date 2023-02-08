<?php

namespace App\Http\Controllers;

use App\Mail\PermitUpdated;
use App\Models\Permit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class PermitController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'uuid' => ['required', 'uuid'],
            'status' => ['required', Rule::in(['accepted', 'denied'])]
        ]);

        $permit = Permit::where('uuid', $validated['uuid'])->get()->first();

        $permit->update([
            'status' => $validated['status']
        ]);

        Mail::to($permit->user->email)
            ->send(new PermitUpdated($permit->user->name, $validated['uuid'], $validated['status']));

        return redirect()->back();
    }
}
