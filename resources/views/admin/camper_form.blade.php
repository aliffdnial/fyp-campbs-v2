@extends('layouts.mytemplate_system')

@section('pagetitle')
Admin Register Form
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    Camper Register
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Manage Profile</li>
    @endsection
    <div class="card-body mt-4">
        @if($camper->id)<!-- TO CHECK id ALREADY EXIST OR NOT -->
        <form action="{{ route('app.admin.camper.update', $camper->id) }}" method="post">
        <input type="hidden" name="_method" value="PUT">
        @else
        <form action="{{ route('app.admin.camper.store') }}" method="post">
        @endif
        @csrf

        <table class="table">
            <tr>
                <th>Name</th>
                <td>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $camper->name) }}">
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
                    <input type="text" class="form-control" name="address" value="{{ old('address', $camper->address) }}">
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
                    <input type="text" class="form-control" name="phonenum" value="{{ old('phonenum', $camper->phonenum) }}">
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
                    <input type="email" class="form-control" name="email" value="{{ old('email', $camper->email) }}">
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
            <tr>
                <th>User Type</th>
                <td>
                    <select class="form-control" name="usertype">
                        <option value="0" @if(old('usertype') == "0") selected @endif)>Camper</option>
                        <option value="1" @if(old('usertype', $camper->usertype) == "1") selected @endif)>Admin</option>
                    </select>
                </td>
            </tr>
        </table>
        <a href="{{ route('app.admin.camper.index') }}" class="btn btn-info">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection