<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Facades\Agent;
use App\Models\Profile;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasPermissionTo('Read Users')) {
            abort(403);
        }
        $users = User::all();
        return view('backend.users.index')
            ->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermissionTo('Create Users')) {
            abort(403);
        }
        $roles = Role::where('role_for', 'Admin')->get();
        return view('backend.users.create')
            ->withRoles($roles);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // {
    //     if (!auth()->user()->hasPermissionTo('Create Users')) {
    //         abort(403);
    //     }

    //     // dd($request->all());
    //     $request->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'username' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);
    //     $username = str_replace(' ', '-', $request->username);
    //     // check username exist
    //     $usernamefind = User::where('username', $username)->first();
    //     if ($usernamefind) {
    //         $username = $username . '-' . str_random(2);
    //     }
    //     $user = User::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'username' => $username,
    //         'status' => $request->status,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     if (isset($request->roles)) {
    //         foreach ($request->roles as $assignRole) {
    //             $user->assignRole($assignRole);
    //         }
    //     }
    //     $user->save();
    //     Password::sendResetLink($request->only(['email']));
    //     alert()->success('New User Added');

    //     return redirect()->route('users.index');
    // }
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone' => 'required',
            'avatar' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'nullable',
            'referral_code' => 'nullable',
            // 'terms' => 'required',

        ]);

        try {
            DB::beginTransaction();

            $username = str_replace(' ', '-', $request->username);

            $usernamefind = User::where('username', $username)->first();
            if ($usernamefind) {
                $username = $username . '-' . str_random(2);
            }
            $imageName = 'placeholder.png';
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

            }
            $background = 'default/cover/placeholder.png';

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
                $background = 'uploads/cover_images/' . $imageName_background;
            }
            $referral_code = generateAlpha(3) . generateAlpha(3);
            if (User::where('referral_code', $referral_code)->exists()) {
                $referral_code = generateAlpha(2) . generateAlpha(4);
            }

            $referral_code_find = User::where('referral_code', $request->referral_code)->first();
            if (env('APP_ENV') == 'local') {
                $location_info = Location::get('182.185.236.113');
            } else {
                $location_info = Location::get($request->ip());
            }

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'referral_code' => $referral_code,
                'referral_code_entered' => $request->referral_code,
                'refer_by_id' => $referral_code_find ? $referral_code_find->id : 1,
                'username' => $username,
                'phone' => $request->phone,
                'email' => $request->email,
                'terms' => $request->terms ? 1 : 1,
                'password' => Hash::make(getRandomString()),
                'status' => 1,
                'type' => $request->account_type,
                'expiry' => Carbon::now()->addDays(14)->format('Y-m-d'),
                'country_name' => $location_info->countryName,
                'city_name' => $location_info->cityName,
                'zip_code' => $location_info->zipCode,
                'region_name' => $location_info->regionName,
                'device' => Agent::device(),
                'platform' => Agent::platform(),
                'platform_version' => Agent::version(Agent::platform()),
                'browser' => Agent::browser(),
                'browser_version' => Agent::version(Agent::browser()),
            ]);

            $profile = Profile::create([
                'user_id' => $user->id,
                'bio' => $request->bio,
                'organization' => $request->organization,
                'designation' => $request->designation,
                'cover_image' => $background,
                'website' => $request->website,
                'address' => $request->address,
            ]);

            if (isset($request->roles)) {
                foreach ($request->roles as $assignRole) {
                    $user->assignRole($assignRole);
                }
            } else {
                $user->assignRole('Member');
            }

            event(new Registered($user));
            DB::commit();
            info('User Registered', [
                'user' => $user,
                'profile' => $profile,
            ]);
            // Auth::login($user);
            Password::sendResetLink($request->only(['email']));
            alert()->success('New User Added');
            return redirect()->route('users.index');
            // return redirect(RouteServiceProvider::HOME);

        } catch (\Throwable $th) {
            DB::rollback();
            info($th);
            alert()->error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->hasPermissionTo('Read Users')) {
            abort(403);
        }

        return redirect()->route('users.edit', $id);

        $user = User::findOrFail($id);
        $roles = Role::where('role_for', 'ar')->get();

        return view('backend.users.show')
            ->withUser($user)
            ->withRoles($roles);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasPermissionTo('Update Users')) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $roles = Role::where('role_for', 'Admin')->get();
        return view('backend.users.edit')
            ->withUser($user)
            ->withRoles($roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasPermissionTo('Update Users')) {
            abort(403);
        }
        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|confirmed', Rules\Password::defaults(),
            'address' => 'required',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'google' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'pinterest' => 'nullable|string|max:255',
            'bio' => 'required|string|max:255',

        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->bio = $request->bio;
        $user->organization = $request->organization;
        $user->designation = $request->designation;

        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->instagram = $request->instagram;
        $user->twitter = $request->twitter;
        $user->facebook = $request->facebook;
        $user->google = $request->google;
        $user->linkedin = $request->linkedin;
        $user->youtube = $request->youtube;
        $user->tiktok = $request->tiktok;
        $user->pinterest = $request->pinterest;

        // $user->password = Hash::make($request->password);
        if (isset($request->roles)) {
            $user->roles()->detach();
            foreach ($request->roles as $assignRole) {
                $user->assignRole($assignRole);
            }
        }
        if ($request->avatar) {
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = getRandomString() . '-' . time() . '.' . $extension;
            $file->move('uploads/avatars', $filename);
            $path = 'uploads/avatars/' . $filename;
            $user->avatar = $path;
        }
        if ($request->cover_image) {
            $request->validate([
                'cover_image' => 'mimes:jpeg,png,jpg|max:2048',
            ]);
            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalExtension();
            $filename = getRandomString() . '-' . time() . '.' . $extension;
            $file->move('uploads/cover_images', $filename);
            $background = 'uploads/cover_images/' . $filename;
            $user->cover_image = $background;
        }

        $user->save();

        alert()->success('User Details Updated');

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {if (!auth()->user()->hasPermissionTo('Delete Users')) {
        abort(403);
    }

        $user = User::findOrFail($id);
        if ($user->id == Auth::user()->id) {
            Alert::error('Sorry', 'You Cannot Delete Yourself');
            alert()->error('Cannot Delete this user');

        } else {
            $user->delete();
        }
        alert()->info('User Deleted');
        return redirect()->back();}
    public function reset_password(User $user)
    {
        Password::sendResetLink(['email' => $user->email]);
        alert()->info('Password Reset Link Sent', ['email' => $user->email]);
        return redirect()->route('users.index');
    }

    public function updatePassword(Request $request)
    {
        // password, confirm_password, user_id

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        alert()->success('Password Updated');
        return redirect()->back();
    }
}
