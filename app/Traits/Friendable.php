<?php

namespace App\Traits;

use App\Friendship;

trait Friendable
{
    public function addFriend($userRequestedId)
    {
        if ($this->id === $userRequestedId)
        {
            return 0;
        }

        if ($this->hasPendingFriendRequestSentTo($userRequestedId) === 1)    
        {   
            return 'Allready sent a friend request';
        }

        if ($this->hasPendingFriendRequestFrom($userRequestedId) === 1)
        {
            return $this->acceptFriend($userRequestedId);
        }

        if ($this->isFriendsWith($userRequestedId) === 1)
        {
            return 'allready friends';
        }

        $friendship = Friendship::create([
            'requester' => $this->id,
            'requested' => $userRequestedId
        ]);

        if ($friendship)
        {
            return response()->json($friendship, 200);
        }

        return response()->json('fail', 501);
    }

    public function acceptFriend($requester)
    {
        if ($this->hasPendingFriendRequestFrom($requester) === 0)
        {
            return 0;
        }

        $friendship = Friendship::where('requester', $requester)
                                ->where('requested', $this->id)
                                ->first();

        if ($friendship)
        {
            $friendship->update([
                'status' => 1
            ]);

            return 1;
        } 

        return 0;
    }

    public function friends()
    {
        $friends = [];

        $f1 = Friendship::where('status', 1)
                        ->where('requester', $this->id)
                        ->get();

        foreach($f1 as $friendship)
        {
            array_push($friends, \App\User::find($friendship->requested));
        }

        $friends2 = [];

        $f2 = Friendship::where('status', 1)
                        ->where('requested', $this->id)
                        ->get();

        foreach($f2 as $friendship)
        {
            array_push($friends2, \App\User::find($friendship->requester));
        }

        return array_merge($friends, $friends2);
    }

    public function pendingFriendRequest()
    {
        $users = [];

        $friendships = Friendship::where('status', 0)
                                ->where('requested', $this->id)
                                ->get();

        foreach ($friendships as $friendship) 
        {
            array_push($users, \App\User::find($friendship->requester));
        }

        return $users;
    }

    public function friendsIds()
    {
        return collect($this->friends())->pluck('id')->toArray();
    }

    public function isFriendsWith($userId)
    {
        if (in_array($userId, $this->friendsIds()))
        {
            return 1;
        }
        else 
        {
            return 0;
        }
    }

    public function pendingFriendRequestIds()
    {
        return collect($this->pendingFriendRequest())->pluck('id')->toArray();
    }

    public function pendingFriendRequestSent()
    {
        $users = [];

        $friendships = Friendship::where('status', 0)
                                ->where('requester', $this->id)
                                ->get();

        foreach($friendships as $friendship)
        {
            array_push($users, \App\User::find($friendship->requested));
        }

        return $users;
    }

    public function pendingFriendRequestSentIds()
    {
        return collect($this->pendingFriendRequestSent())->pluck('id')->toArray();
    }

    public function hasPendingFriendRequestFrom($userId)
    {
        if (in_array($userId, $this->pendingFriendRequestIds()))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function hasPendingFriendRequestSentTo($userId)
    {
        if (in_array($userId, $this->pendingFriendRequestSentIds()))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}