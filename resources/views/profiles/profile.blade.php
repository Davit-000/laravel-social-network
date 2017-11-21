@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        {{ $user->name }}'s Profile
                    </p>                
                </div>
                <div class="panel-body">
                    <center>
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" height="70px" width="70px" class="img-circle">
                    </center> 
                    <br>
                    <p class="text-center">
                        {{ $user->profile->location }}                        
                    </p>      
                    <br>
                    <p class="text-center">
                        @if(Auth::id() == $user->id)
                            <a href="{{ route('profile.edit', ['slug' => $user->slug]) }}" class="btn btn-info">
                                Edit profile
                            </a>
                        @endif
                    </p>             
                </div>
            </div>

            @if(Auth::id() !== $user->id)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <friend :profile_user_id="{{ $user->id }}"></friend>
                    </div>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        About me
                    </p>                
                </div>
                <div class="panel-body">
                    <p class="text-center">
                        {{ $user->profile->about }}
                    </p>           
                </div>
            </div>
        </div>
    </div>
@endsection