<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        return view('user.card.index');
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->card = $request->card;
        $user->save();
        alert()->success('Card Updated Successfully', 'Success');
        return redirect()->back();
    }
}
