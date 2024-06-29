<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\ShortLink;
use App\Models\Geolocation;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Jenssegers\Agent\Facades\Agent;
use JeroenDesloovere\VCard\VCard;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.pages.index');
    }
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function privacy()
    {
        return view('frontend.pages.privacy');
    }

    public function slug(Request $request, $slug)
    {
        dd(request->ip());
        $user = User::where('username', $slug)->first();

        if ($user) {
            try {
                $profile = Profile::where('user_id', $user->id)->first();
                DB::beginTransaction();
                if (env('APP_ENV') == 'local') {
                    $location_info = Location::get('182.185.236.113');
                } else {
                    $location_info = Location::get($request->ip());
                }
                if ($location_info != null) {
                    $findIP = Geolocation::where('user_id', $user->id)->where('ip_address', $request->ip())->first();

                    if ($findIP) {
                        $location_id = $findIP->id;
                    }
                    if (!$findIP) {

                        $location = Geolocation::create([
                            'user_id' => $user->id,
                            'ip_address' => $request->ip(),
                            'countryName' => $location_info->countryName,
                            'countryCode' => $location_info->countryCode,
                            'regionCode' => $location_info->regionCode,
                            'regionName' => $location_info->regionName,
                            'cityName' => $location_info->cityName,
                            'zipCode' => $location_info->zipCode,
                            'isoCode' => $location_info->isoCode,
                            'postalCode' => $location_info->postalCode,
                            'latitude' => $location_info->latitude,
                            'longitude' => $location_info->longitude,
                            'metroCode' => $location_info->metroCode,
                            'areaCode' => $location_info->areaCode,
                            'timezone' => $location_info->timezone,
                            'device' => Agent::device(),
                            'platform' => Agent::platform(),
                            'platform_version' => Agent::version(Agent::platform()),
                            'browser' => Agent::browser(),
                            'browser_version' => Agent::version(Agent::browser()),
                        ]);
                        $location_id = $location->id;
                    }

                }
                $findDevice = Device::where('user_id', $user->id)->where('ip_address', $request->ip())->where('geolocation_id', $location_id)->where('device', Agent::device())->where('platform', Agent::platform())->first();
                if (!$findDevice) {

                    $deviceType = 'other';
                    if (Agent::isDesktop()) {
                        $deviceType = 'Desktop';
                    } elseif (Agent::isTablet()) {
                        $deviceType = 'Tablet';
                    } elseif (Agent::isPhone()) {
                        $deviceType = 'Phone';
                    } else {
                        $deviceType = 'Other';
                    }


                    $device = Device::create([
                        'user_id' => $user->id,
                        'geolocation_id' => $location_id,
                        'ip_address' => $request->ip(),
                        'device' => Agent::device(),
                        'device_type' => $deviceType,
                        'platform' => Agent::platform(),
                        'platform_version' => Agent::version(Agent::platform()),
                        'browser' => Agent::browser(),
                        'browser_version' => Agent::version(Agent::browser()),
                    ]);

                    $user->reach = $user->reach + 1;
                    $user->save();
                }

                $user->count = $user->count + 1;
                $user->save();
                DB::commit();
                return view('frontend.pages.cards.templates.template1')
                ->with('user', $user)
                ->with('profile', $profile)
                ->with('extra_class', 'd-none');

                return view('frontend.pages.cards.index')
                ->with('user', $user)
                ->with('profile', $profile)
                ->with('extra_class', 'd-none');
            } catch (\Throwable$th) {
                DB::rollback();
                throw $th;
            }

        } else {
            if (auth()->user()) {
                // dd('hello');
                Auth::guard('web')->logout();
                $request->session()->invalidate();
            }
            return view('frontend.pages.auth.register')
                ->with('slug', $slug)
                ->with('extra_class', '');
        }
    }

    public function profileEdit($slug)
    {
        if (!auth()->user()) {
            return redirect()->route('login.user');
        }else{
            return redirect()->route('user.profile');
        }
    }

    public function profileUpdate(Request $request, $slug)
    {
        $user = User::where('username', $slug)->first();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
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
        ]);

        if ($user) {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
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

            if ($request->password) {
                $user->password = Hash::make($request->password);
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
            return redirect()->route('slug', $slug);
        } else {
            return redirect()->route('slug', $slug);
        }
    }

    public function userLogin()
    {
        return view('frontend.pages.auth.login');
    }

    public function downloadVCard($id)
    {

        try {

            $user = User::where('username', $id)->firstOrFail();
            $vcard = new VCard();

            // define variables
            $lastname = $user->last_name;
            $firstname = $user->first_name;
            $additional = '';
            $prefix = '';
            $suffix = '';

            // add personal data
            $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

            // add work data
            $vcard->addCompany($user->organization);
            $vcard->addJobtitle($user->designation);
            $vcard->addRole($user->designation);
            $vcard->addEmail($user->email);
            $vcard->addPhoneNumber($user->phone, 'PREF;WORK');
            // $vcard->addPhoneNumber(123456789, 'WORK');
            $vcard->addAddress(null, null, $user->address, null, null, null, null);
            // $vcard->addLabel('street, worktown, workpostcode Belgium');
            $vcard->addURL($user->url);
            if (isset($user->youtube)) {
                $vcard->addURL('https://www.youtube.com/' . $user->youtube, 'TYPE=Youtube');
            }
            if (isset($user->instagram)) {
                $vcard->addURL('https://www.instagram.com/' . $user->instagram, 'TYPE=Instagram');
            }
            if (isset($user->twitter)) {
                $vcard->addURL('https://www.twitter.com/' . $user->twitter, 'TYPE=Twitter');
            }
            if (isset($user->facebook)) {
                $vcard->addURL('https://www.facebook.com/' . $user->facebook, 'TYPE=Facebook');
            }
            if (isset($user->google)) {
                $vcard->addURL('https://www.google.com/' . $user->google, 'TYPE=Google');
            }
            if (isset($user->linkedin)) {
                $vcard->addURL('https://www.linkedin.com/' . $user->linkedin, 'TYPE=Linkedin');
            }
            if (isset($user->linkedin)) {
                $vcard->addURL('https://www.linkedin.com/' . $user->linkedin, 'TYPE=Linkedin');
            }
            if (isset($user->tiktok)) {
                $vcard->addURL('https://www.tiktok.com/' . $user->tiktok, 'TYPE=Tiktok');
            }
            if (isset($user->pinterest)) {
                $vcard->addURL('https://www.pinterest.com/' . $user->pinterest, 'TYPE=Pinterest');
            }

            if ($user->avatar) {
                $vcard->addPhoto(env('APP_URL') . $user->avatar);

            } else {
                $vcard->addPhoto('https://ui-avatars.com/api/?name=' . $user->first_name . '+' . $user->last_name . '&background=0D8ABC&color=fff');
            }

            return $vcard->download();
        } catch (\Throwable$th) {

            alert()->error('Error', 'Something went wrong!');
            return redirect()->back();

        }

    }


    public function shortlinkOpener($slug)
    {
        $shortlink = ShortLink::where('slug', $slug)->first();
        if ($shortlink) {
            return redirect($shortlink->link);
        } else {
            return redirect()->route('home');
        }
    }
}
