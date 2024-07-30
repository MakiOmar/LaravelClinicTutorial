@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add Patient</h3>
    <form action="{{ route('store.patient') }}" method="POST" enctype="multipart/form-data">
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
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
        </div>
        <div class="form-group">
            <label for="house_number">House Number</label>
            <input type="text" class="form-control" id="house_number" name="house_number" value="{{ old('house_number') }}" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="stage">Stage</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="stage" id="stage1" value="1" @checked(old('stage', '1')) required>
                <label class="form-check-label" for="stage1">1</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="stage" id="stage2" value="2" @checked(old('stage', '2')) required>
                <label class="form-check-label" for="stage2">2</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="stage" id="stage3" value="3" @checked(old('stage', '3')) required>
                <label class="form-check-label" for="stage3">3</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="stage" id="stage4" value="4" @checked(old('stage', '4')) required>
                <label class="form-check-label" for="stage4">4</label>
            </div>
        </div>
        <div class="form-group">
            <label for="diagnose">Diagnose</label>
            <input type="text" class="form-control" id="diagnose" name="diagnose" value="{{ old('diagnose') }}" required>
        </div>
        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" required>{{ old('details') }}</textarea>
        </div>
        <div class="form-group">
            <label for="prescription">Prescription</label>
            <input type="file" class="form-control" id="prescription"  name="prescription" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Patient</button>
    </form>
</div>
@endsection
