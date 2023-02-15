<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        abort(404);
        return view('frontend.pages.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'username' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);
    //     $username = str_replace(' ', '-', $request->username);
    //     // check username exist
    //     $usernamefind = User::where('username', $username)->first();
    //     if ($usernamefind) {
    //         $username = $username.'-'.str_random(2);
    //     }
    //     $user = User::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'username' => $username,
    //         'status' => $request->status,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));
    //     Auth::login($user);
    //     return redirect(RouteServiceProvider::HOME);
    // }

}

// 'instagram' => 'nullable|string|max:255',
// 'twitter' => 'nullable|string|max:255',
// 'facebook' => 'nullable|string|max:255',
// 'google' => 'nullable|string|max:255',
// 'linkedin' => 'nullable|string|max:255',
// 'youtube' => 'nullable|string|max:255',
// 'tikTok' => 'nullable|string|max:255',
// 'pinterest' => 'nullable|string|max:255',

// 'instagram' => $request->instagram,
// 'twitter' => $request->twitter,
// 'facebook' => $request->facebook,
// 'google' => $request->google,
// 'linkedin' => $request->linkedin,
// 'youtube' => $request->youtube,
// 'tiktok' => $request->tiktok,
// 'pinterest' => $request->pinterest,

// $file = $request->file('cover_image');
// $extension = $file->getClientOriginalExtension();
// $filename = getRandomString().'-'.time() . '.' . $extension;
// $file->move('uploads/cover_images', $filename);

// $file = $request->file('avatar');
// $extension = $file->getClientOriginalExtension();
// $filename = getRandomString().'-'.time() . '.' . $extension;
// $file->move('uploads/avatars', $filename);
// $path = 'uploads/avatars/'.$filename;
