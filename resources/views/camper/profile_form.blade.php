@extends('layouts.mytemplate')

@section('pagetitle')
Camper Profile Form
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    Profile Details
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper Profile Form</li>
    @endsection
    <div class="card-body mt-4">
        @if($profile->id)<!-- TO CHECK id ALREADY EXIST OR NOT -->
        <form action="{{ route('app.profile.update', $profile->id) }}" method="post">
        <input type="hidden" name="_method" value="PUT">
        @else
        <form action="{{ route('app.profile.store') }}" method="post">
        @endif
        @csrf

        <table class="table">
            <tr>
                <th>Name</th>
                <td>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $profile->name) }}">
                    @error('name')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Address</th>
                <td>
                    <input type="text" class="form-control" name="address" value="{{ old('address', $profile->address) }}">
                    @error('address')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>
                    <input type="text" class="form-control" name="phonenum" value="{{ old('phonenum', $profile->phonenum) }}">
                    @error('phonenum')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $profile->email) }}">
                    @error('email')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Password</th>
                <td>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Password Confirm</th>
                <td>
                    <input type="password" class="form-control" name="password_confirmation">
                    @error('password_confirmation')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
        </table>
        <a href="{{ route('app.profile.index') }}" class="btn btn-info">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection