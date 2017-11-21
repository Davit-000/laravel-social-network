@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit profile</div>

                <center class="panel-body">
                    <form action="{{ route('profile.update', ['slug' => $profile->user->slug]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <center>
                            <img src="{{ Storage::url($profile->user->avatar) }}" alt="{{ $profile->user->name }}" class="img-responsive" height="100" width="100">
                        </center>                        

                        <div class="form-group{{ $errors->has('avatar') ? 'has-error' : '' }}">
                            <label for="avatar" class="control-label">Avatar</label>
                            <input type="file" name="avatar" class="form-control" id="avatar" accept="*/image">
                            @if($errors->has('avatar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('location') ? 'has-error' : '' }}">
                            <label for="location" class="control-label">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ $profile->location }}" id="location">
                            @if($errors->has('location'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('about') ? 'has-error' : '' }}">
                            <label for="about" class="control-label">About you</label>
                            <textarea type="text" name="about" id="about" class="form-control">{{ $profile->about }}</textarea>
                            @if($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
