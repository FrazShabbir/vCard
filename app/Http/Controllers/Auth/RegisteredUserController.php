<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

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


    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'phone' => 'required',
            'avatar' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed', Rules\Password::defaults(),
            'address' => 'nullable',

            // 'instagram' => 'nullable|string|max:255',
            // 'twitter' => 'nullable|string|max:255',
            // 'facebook' => 'nullable|string|max:255',
            // 'google' => 'nullable|string|max:255',
            // 'linkedin' => 'nullable|string|max:255',
            // 'youtube' => 'nullable|string|max:255',
            // 'tikTok' => 'nullable|string|max:255',
            // 'pinterest' => 'nullable|string|max:255',
            'terms' => 'required',

        ]);

        $username = str_replace(' ', '-', $request->slug);

        $usernamefind = User::where('username', $username)->first();
        if ($usernamefind) {
            $username = $username . '-' . str_random(2);
        }

        if ($request->avatar) {
            $request->validate([
                'avatar' => 'mimes:jpeg,png,jpg|max:2048',
            ]);
            $image = $request->file('avatar');
            $imageName = getRandomString() . '-' . time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/avatars');
            $img = Image::make($image->path());
            // $img->encode('png', 75)->save($destinationPath.'/'.$imageName);

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);

            $destinationPath = public_path('/uploads/avatars/original');
            $image->move($destinationPath, $imageName);

            // $file = $request->file('avatar');
            // $extension = $file->getClientOriginalExtension();
            // $filename = getRandomString().'-'.time() . '.' . $extension;
            // $file->move('uploads/avatars', $filename);
            // $path = 'uploads/avatars/'.$filename;
        }

        if ($request->cover_image) {
            $request->validate([
                'cover_image' => 'mimes:jpeg,png,jpg|max:2048',
            ]);
            $image = $request->file('cover_image');
            $imageName_background = getRandomString() . '-' . time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/cover_images');
            $img = Image::make($image->path());
            // $img->encode('png', 75)->save($destinationPath.'/'.$imageName_background);

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName_background);

            $destinationPath = public_path('/uploads/cover_images/original');
            $image->move($destinationPath, $imageName_background);

            // $file = $request->file('cover_image');
            // $extension = $file->getClientOriginalExtension();
            // $filename = getRandomString().'-'.time() . '.' . $extension;
            // $file->move('uploads/cover_images', $filename);
            $background = 'uploads/cover_images/' . $imageName_background;

        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'terms' => $request->terms,
            'status' => 1,
            'type' => UserEnum::Active,
            'expiry' => Carbon::now()->addDays(14)->format('Y-m-d'),
        ]);
        
        $profile = Profile::create([
            'user_id' => $user->id,
            'bio' => $request->bio,
            'organization' => $request->organization,
            'designation' => $request->designation,
            'avatar' => 'uploads/avatars/' . $imageName??'placeholder.png',
            'cover_image' => $background ?? null,
            'website' => $request->website,
            'address' => $request->address,
        ]);

        // 'instagram' => $request->instagram,
        // 'twitter' => $request->twitter,
        // 'facebook' => $request->facebook,
        // 'google' => $request->google,
        // 'linkedin' => $request->linkedin,
        // 'youtube' => $request->youtube,
        // 'tiktok' => $request->tiktok,
        // 'pinterest' => $request->pinterest,

        $user->assignRole('Member');
        event(new Registered($user));

        return redirect()->route('slug', $user->username);
    }
}
