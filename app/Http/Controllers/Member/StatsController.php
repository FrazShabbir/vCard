<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function stats()
    {
        $user = auth()->user();
        return view('user.stats.stats')
            ->with('user', $user);
    }
}
