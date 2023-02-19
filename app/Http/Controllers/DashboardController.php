<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->hasRole('Member')) {

            return redirect()->route('member.dashboard');
        } else {

            return redirect()->route('admin.dashboard');
        }
    }

    public function memberDashboard()
    {
        $user = Auth::user();
        // $profile = Profile::where('user_id', $user->id)->first();
        // if (!$profile->bio or !$profile->organization and !$profile->address) {
        //     return redirect()->route('user.profile');
        // }
        return view('user.dashboard.dashboard')
            ->with('user', $user);
    }

    public function adminDashboard()
    {
        $user = Auth::user();
        return view('backend.dashboard.dashboard')
            ->with('user', $user);

    }

}
