<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class FriendshipsController extends Controller
{
    public function check($id)
    {
        if (Auth::user()->isFriendsWith($id) === 1)
        {
            return ['status' => 'friends'];
        }

        if (Auth::user()->hasPendingFriendRequestFrom($id))
        {
            return ['status' => 'pending'];
        }

        if (Auth::user()->hasPendingFriendRequestSentTo($id))
        {
            return ['status' => 'waiting'];
        }

        return ['status' => 0];
    }

    public function addFriend($id)
    {
        // Sending notifications, email, broadcasting.

        $response = Auth::user()->addFriend($id);

        User::find($id)->notify(new \App\Notifications\NewFrienRequest(Auth::user()));

        return $response;
    }

    public function acceptFriend($id)
    {
        $response = Auth::user()->acceptFriend($id);

        User::find($id)->notify(new \App\Notifications\FriendRequestAccepted(Auth::user()));

        return $response;
    }
}
