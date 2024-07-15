<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

        // get all engagements of this user as by months
        // $engagements = $user->engagements()
        //     ->selectRaw('count(*) as count, monthname(created_at) as month')
        //     ->groupBy('month')
        //     ->get();

        // Get the current date and start date for the past 12 months
        $end = Carbon::now();
        $start = $end->copy()->subMonths(11);
        $engagements = [];
        $locations = [];
        $devices = [];
        for ($i = 0; $i < 12; $i++) {
            $month = $start->copy()->addMonths($i)->format('F');
            $engagements[$month] = 0;
            $locations[$month] = 0;
            $devices[$month] = 0;
        }

        $userengagements = $user->engagements()
            ->selectRaw('count(*) as count, monthname(created_at) as month')
            ->whereBetween('created_at', [$start->startOfMonth(), $end->endOfMonth()])
            ->groupBy(DB::raw('monthname(created_at)'))
            ->pluck('count', 'month');

        foreach ($userengagements as $month => $count) {
            $engagements[$month] = $count;
        }

        // get user geolocation with same format as above
        $locationsdata = $user->locations()
            ->selectRaw('count(*) as count, monthname(created_at) as month')
            ->whereBetween('created_at', [$start->startOfMonth(), $end->endOfMonth()])
            ->groupBy(DB::raw('monthname(created_at)'))
            ->pluck('count', 'month');

        foreach ($locationsdata as $month => $count) {
            $locations[$month] = $count;
        }

        $devicesData = $user->devices()
            ->selectRaw('count(*) as count, monthname(created_at) as month')
            ->whereBetween('created_at', [$start->startOfMonth(), $end->endOfMonth()])
            ->groupBy(DB::raw('monthname(created_at)'))
            ->pluck('count', 'month');

        foreach ($devicesData as $month => $count) {
            $devices[$month] = $count;
        }

        // from devices get count of each platform
        $platforms = $user->devices()
            ->selectRaw('platform, count(*) as count')
            ->groupBy('platform')
            ->pluck('count', 'platform');

        $platform_total = $platforms->sum();

        $platforms_percentages = $platforms->map(function ($count) use ($platform_total) {
            return ($count / $platform_total) * 100;
        });

        $devices_count = $user->devices()
            ->selectRaw('device, count(*) as count')
            ->groupBy('device')
            ->pluck('count', 'device');
        $device_total = $devices_count->sum();
        $devices_percentages = $devices_count->map(function ($count) use ($device_total) {
            return ($count / $device_total) * 100;
        });
        $clients = $user->devices()
            ->selectRaw('device_type, count(*) as count')
            ->groupBy('device_type')
            ->pluck('count', 'device_type');
        $client_total = $clients->sum();
        $clients_percentages = $clients->map(function ($count) use ($client_total) {
            return ($count / $client_total) * 100;
        });

        $locationsNames = $user->locations()
            ->selectRaw('country_name, count(*) as count')
            ->groupBy('country_name')
            ->pluck('count', 'country_name');
        // dd($locationsNames);
        $locations_total = $locationsNames->sum();
        $locations_percentages = $locationsNames->map(function ($count) use ($locations_total) {
            return ($count / $locations_total) * 100;
        });

        // $socialLinks = SocialLink::where('profile_id', $user->profile->id)
        // ->join('short_links', 'social_links.short_link_id', '=', 'short_links.id')
        // ->select('social_links.name', 'short_links.link', 'short_links.count')
        // ->get();

        // $socialLinks = SocialLink::where('profile_id', $user->profile->id)
        //     ->join('short_links', 'social_links.short_link_id', '=', 'short_links.id')
        // // ->select('social_links.name', 'short_links.link', 'short_links.count')
        //     ->get();
        // $totalLinks = $socialLinks->count();
        // $linksCount = $socialLinks->sum('count');

        // $link_percentages = $socialLinks->mapWithKeys(function ($item) use ($linksCount) {
        //     return [$item->name => ($item->count / $linksCount) * 100];
        // });
        $socialLinks = SocialLink::with(['shortlink'])->where('profile_id', $user->profile->id)->get();
        // dd($socialLinks);
        $linksCount = $socialLinks->sum(function ($socialLink) {
            return $socialLink->shortlink ? $socialLink->shortlink->count : 0;
        });

        return view('user.dashboard.dashboard')
            ->with('user', $user)
            ->with('engagements', $engagements)
            ->with('locations', $locations)
            ->with('socialLinks', $socialLinks)
            // ->with('link_percentages', $link_percentages)
            // ->with('totalLinks', $totalLinks)
            ->with('linksCount', $linksCount)

            ->with('devices', $devices)
            ->with('platforms', $platforms)
            ->with('platforms_percentages', $platforms_percentages)
            ->with('platform_total', $platform_total)

            ->with('clients', $clients)
            ->with('clients_percentages', $clients_percentages)
            ->with('client_total', $client_total)

            ->with('devices_count', $devices_count)
            ->with('devices_percentages', $devices_percentages)
            ->with('device_total', $device_total)

            ->with('locationsNames', $locationsNames)
            ->with('locations_percentages', $locations_percentages)
            ->with('locations_total', $locations_total);

    }

    public function adminDashboard()
    {
        $end = Carbon::now();
        $start = $end->copy()->subMonths(11);

        // count sum of all reach in users table for all time
        $totalReach = DB::table('users')->sum('reach');
        $totalCount = DB::table('users')->sum('count');
        $totalDevices = DB::table('devices')->count();
        $totalLocations = DB::table('geolocations')->count();

        $engagements = [];
        $locations = [];
        $devices = [];
        for ($i = 0; $i < 12; $i++) {
            $month = $start->copy()->addMonths($i)->format('F');
            $engagements[$month] = 0;
            $locations[$month] = 0;
            $devices[$month] = 0;
        }

        $userengagements = DB::table('engagements')
            ->selectRaw('count(*) as count, monthname(created_at) as month')
            ->whereBetween('created_at', [$start->startOfMonth(), $end->endOfMonth()])
            ->groupBy(DB::raw('monthname(created_at)'))
            ->pluck('count', 'month');

        foreach ($userengagements as $month => $count) {
            $engagements[$month] = $count;
        }

        $locationsdata = DB::table('geolocations')
            ->selectRaw('count(*) as count, monthname(created_at) as month')
            ->whereBetween('created_at', [$start->startOfMonth(), $end->endOfMonth()])
            ->groupBy(DB::raw('monthname(created_at)'))
            ->pluck('count', 'month');

        foreach ($locationsdata as $month => $count) {
            $locations[$month] = $count;
        }

        $devicesData = DB::table('devices')
            ->selectRaw('count(*) as count, monthname(created_at) as month')
            ->whereBetween('created_at', [$start->startOfMonth(), $end->endOfMonth()])
            ->groupBy(DB::raw('monthname(created_at)'))
            ->pluck('count', 'month');

        foreach ($devicesData as $month => $count) {
            $devices[$month] = $count;
        }

        $platforms = DB::table('devices')
            ->selectRaw('platform, count(*) as count')
            ->groupBy('platform')
            ->pluck('count', 'platform');

        $platform_total = $platforms->sum();

        $platforms_percentages = $platforms->map(function ($count) use ($platform_total) {
            return ($count / $platform_total) * 100;
        });

        $devices_count = DB::table('devices')
            ->selectRaw('device, count(*) as count')
            ->groupBy('device')
            ->pluck('count', 'device');
        $device_total = $devices_count->sum();
        $devices_percentages = $devices_count->map(function ($count) use ($device_total) {
            return ($count / $device_total) * 100;
        });

        $clients = DB::table('devices')
            ->selectRaw('device_type, count(*) as count')
            ->groupBy('device_type')
            ->pluck('count', 'device_type');
        $client_total = $clients->sum();
        $clients_percentages = $clients->map(function ($count) use ($client_total) {
            return ($count / $client_total) * 100;
        });

        $locationsNames = DB::table('geolocations')
            ->selectRaw('country_name, count(*) as count')
            ->groupBy('country_name')
            ->pluck('count', 'country_name');

        $locations_total = $locationsNames->sum();
        $locations_percentages = $locationsNames->map(function ($count) use ($locations_total) {
            return ($count / $locations_total) * 100;
        });

        $socialLinks = SocialLink::with(['shortlink'])->get();
        $linksCount = $socialLinks->sum(function ($socialLink) {
            return $socialLink->shortlink ? $socialLink->shortlink->count : 0;
        });

        return view('backend.dashboard.dashboard')
            ->with('engagements', $engagements)
            ->with('locations', $locations)
            ->with('socialLinks', $socialLinks)
            ->with('linksCount', $linksCount)
            ->with('devices', $devices)
            ->with('platforms', $platforms)
            ->with('platforms_percentages', $platforms_percentages)
            ->with('platform_total', $platform_total)
            ->with('clients', $clients)
            ->with('clients_percentages', $clients_percentages)
            ->with('client_total', $client_total)
            ->with('devices_count', $devices_count)
            ->with('devices_percentages', $devices_percentages)
            ->with('device_total', $device_total)
            ->with('locationsNames', $locationsNames)
            ->with('locations_percentages', $locations_percentages)
            ->with('locations_total', $locations_total)
            ->with('totalReach', $totalReach)
            ->with('totalCount', $totalCount)
            ->with('totalDevices', $totalDevices)
            ->with('totalLocations', $totalLocations);
    }

    public function downloadQRCode()
    {
        $username = auth()->user()->username;
        $url = route('home') . '/' . $username;
        $imageName = $username . '-qrcode.png';

        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="' . $imageName . '"',
        ];

        $callback = function () use ($url) {
            $qrCode = QrCode::eye('circle')->size(200)->generate($url);
            echo $qrCode;
        };

        return new StreamedResponse($callback, 200, $headers);
    }

}
