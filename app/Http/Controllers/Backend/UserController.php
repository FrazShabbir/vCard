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
    {
        if (!auth()->user()->hasPermissionTo('Create Users')) {
            abort(403);
        }

        // dd($request->all());
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $username = str_replace(' ', '-', $request->username);
        // check username exist
        $usernamefind = User::where('username', $username)->first();
        if ($usernamefind) {
            $username = $username . '-' . str_random(2);
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $username,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (isset($request->roles)) {
            foreach ($request->roles as $assignRole) {
                $user->assignRole($assignRole);
            }
        }
        $user->save();
        Password::sendResetLink($request->only(['email']));
        alert()->success('New User Added');

        return redirect()->route('users.index');
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
