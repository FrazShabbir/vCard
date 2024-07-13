<?php

namespace App\Http\Controllers;

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

// Create an array for the last 12 months with zero counts
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
        return view('user.dashboard.dashboard')
            ->with('user', $user)
            ->with('engagements', $engagements)
            ->with('locations', $locations)
            ->with('devices', $devices)
            ->with('platforms', $platforms)
            ->with('platforms_percentages', $platforms_percentages)
            ->with('platform_total', $platform_total)

            ->with('clients', $clients)
            ->with('clients_percentages', $clients_percentages)
            ->with('client_total', $client_total)

            ->with('devices_count', $devices_count)
            ->with('devices_percentages', $devices_percentages)
            ->with('device_total', $device_total);

    }

    public function adminDashboard()
    {
        $user = Auth::user();
        return view('backend.dashboard.dashboard')
            ->with('user', $user);

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
