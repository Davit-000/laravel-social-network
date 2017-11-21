<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\NewFriendRequest;

class ProfilesController extends Controller
{
    public function index($slug)
    {
        $user = User::where('slug', $slug)->first();

        return view('profiles.profile')
            ->with('user', $user);
    }

    public function edit($slug)
    {
        return view('profiles.edit')
            ->with('profile', Auth::user()->profile);
    }

    public function update(Request $request, $slug)
    {    
        $request->validate([
            'location' => 'required',
            'about' => 'required'
        ]);

        Auth::user()->profile()->update([
            'location' => $request->location,
            'about' => $request->about
        ]);

        if ($request->hasFile('avatar')) 
        {
            Auth::user()->update([
                'avatar' => $request->avatar->store('public/avatars')
            ]);
        }

        return back()->with('success', 'Your profile updated');
    }
}
