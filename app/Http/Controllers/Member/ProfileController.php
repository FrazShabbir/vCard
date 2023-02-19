<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function myProfile()
    {
        return view('user.profile.index');
    }
    public function myProfileSave(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        // $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        alert()->success('Profile Updated Successfully', 'Success');
        return redirect()->back();

    }
}
