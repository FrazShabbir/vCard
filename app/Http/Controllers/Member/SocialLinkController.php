<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Models\SocialPlatform;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $platforms = SocialPlatform::all();
        $links = SocialLink::where('profile_id', auth()->user()->profile->id)->get();
        return view('user.social.index')
            ->with('links', $links)
            ->with('platforms', $platforms);
    }
    public function store(Request $request)
    {
        $request->validate([
            'social_platform_id' => 'required',
            'link' => 'required',
            'name' => 'nullable',
        ]);
        $platform = SocialPlatform::find($request->social_platform_id);
        $link = new SocialLink();
        $link->profile_id = auth()->user()->profile->id;
        $link->social_platform_id = $request->social_platform_id;
        $link->name = $platform->name;
        $link->link = $request->link;
        $link->save();
        return back()->with('success', 'Link added successfully');
    }
}
