@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add new user</h3>
    @include( 'layouts.error-messages' )
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ $user->ID }}">
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        
        <div class="form-group">
            <label for="first_name">First name</label>
            <input type="text" class="form-control" id="name" name="first_name" value="{{ old('first_name') }}" required>
        </div>
        
        <div class="form-group">
            <label for="last_name">Last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
        </div>
        
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" required>
        </div>
        
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea type="number" class="form-control" id="bio" name="bio" >{{ old('bio') }}</textarea>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="1"  checked>
                <label class="form-check-label" for="gender">
                Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="0">
                <label class="form-check-label" for="gender">
                Female
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
@endsection
