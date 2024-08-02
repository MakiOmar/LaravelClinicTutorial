@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit user</h3>
    @include( 'layouts.error-messages' )
    <form action="{{ route('user.update', [ 'user' => $user->ID ]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method( 'PUT' )
        <input type="hidden" name="doctor_id" value="{{ $user->ID }}">
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
        </div>

        <div class="form-group">
            <label for="first_name">First name</label>
            <input type="text" class="form-control" id="name" name="first_name" value="{{ $profile->first_name }}" required>
        </div>
        
        <div class="form-group">
            <label for="last_name">Last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $profile->last_name }}" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $profile->address }}" required>
        </div>
        
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" id="age" name="age" value="{{ $profile->age }}" required>
        </div>
        
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea type="number" class="form-control" id="bio" name="bio" >{{ $profile->bio }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Gender</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="1" @checked( old( 'gender', $user->profile->gender ?? '' ) == 1 ) required>
                <label class="form-check-label" for="gender">
                Male
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="0" @checked( old( 'gender', $user->profile->gender ?? '' ) == 0 ) required>
                <label class="form-check-label" for="gender">
                Female
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
@endsection
