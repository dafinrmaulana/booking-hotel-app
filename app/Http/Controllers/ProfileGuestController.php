<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tamu.profile.index');
    }

    public function edit()
    {
        return view('tamu.profile.edit');
    }

    public function update(Request $request)
    {
        $request->user()->update(
            $request->all()
        );

        return redirect()->route('profile.index');
    }
}
