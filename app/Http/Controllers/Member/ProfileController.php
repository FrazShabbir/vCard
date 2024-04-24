<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function myProfile()
    {
        return view('user.profile.index');
    }
    public function myProfileSave(Request $request)
    {
        try {
            db::beginTransaction();
            $user = User::find(auth()->user()->id);
            $profile = Profile::where('user_id', auth()->user()->id)->first();
            if ($request->first_name) {
                $user->first_name = $request->first_name;
            }

            if ($request->last_name) {
                $user->last_name = $request->last_name;
            }

            if ($request->email) {
                $user->email = $request->email;
            }

            if ($request->phone) {
                $user->phone = $request->phone;
            }

            if ($request->organization) {
                $profile->organization = $request->organization;
            }

            if ($request->designation) {
                $profile->designation = $request->designation;
            }
            if ($request->website) {
                $profile->website = $request->website;
            }
            if ($request->bio) {
                $profile->bio = $request->bio;
            }

            if ($request->address) {
                $profile->address = $request->address;
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
                $profile->avatar = $path;
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
                $profile->cover_image = $background;
            }

            $user->save();
            $profile->save();
            db::commit();

            alert()->success('Profile Updated Successfully', 'Success');
            return redirect()->back();

        } catch (\Throwable$th) {
            db::rollback();
            throw $th;

        }

    }
}
