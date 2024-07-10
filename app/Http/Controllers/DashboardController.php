<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

        return view('user.dashboard.dashboard')
            ->with('user', $user);
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
