<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

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
        $permit = Permit::where('uuid', $validated['uuid']);
        $permit->update([
            'status' => $validated['status']
        ]);

        return redirect()->back();
    }
}
