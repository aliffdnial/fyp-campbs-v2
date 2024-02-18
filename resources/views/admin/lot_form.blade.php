@extends('layouts.mytemplate_system')

@section('pagetitle')
Admin Lot Form
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    Admin Lot Form
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Admin Create Lot Form</li>
    @endsection
    <div class="card-body">
        @if($lot->id)<!-- TO CHECK id ALREADY EXIST OR NOT -->
        <form action="{{ route('app.admin.lot.update', $lot->id) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @else
        <form action="{{ route('app.admin.lot.store') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf

        <table class="table mt-4">

            <tr>
                <th>Name<span style="color: red">*</span></th>
                <td>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $lot->name) }}">
                    @error('name')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Size (Pax)<span style="color: red">*</span></th>
                <td>
                    <input type="text" class="form-control" name="size" value="{{ old('size', $lot->size) }}">
                    @error('size')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Capacity (00 x 00)<span style="color: red">*</span></th>
                <td>
                    <input type="text" class="form-control" name="capacity" value="{{ old('capacity', $lot->capacity) }}">
                    @error('capacity')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Facilities Available<span style="color: red">*</span></th>
                <td>
                    <?php
                    $facility = $lot->facilities ? json_decode($lot->facilities) : [];
                    ?>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="facilities[]" value="Plug Point 1" @if(in_array("Plug Point 1", $facility)) checked @endif></td>
                        <td>Plug Point 1</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="facilities[]" value="Plug Point 2" @if(in_array("Plug Point 2", $facility)) checked @endif></td>
                        <td>Plug Point 2</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="facilities[]" value="Sungai Kecil" @if(in_array("Sungai Kecil", $facility)) checked @endif></td>
                            <td>Sungai Kecil</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="facilities[]" value="Parking" @if(in_array("Parking", $facility)) checked @endif></td>
                            <td>Parking</td>
                        </tr>
                    </table>
                    @error('facilities')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Lot Price (RM)<span style="color: red">*</span></th>
                <td>
                    <input type="text" class="form-control" name="price" id="price" placeholder=""
                    value="{{ old('price', number_format($lot->price, 2, '.', '')) }}">
                    @error('price')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Coordinates</th>
                <td>
                    <input type="text" class="form-control" name="coordinates" value="{{ old('coordinates', $lot->coordinates) }}">
                    @error('coordinates')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Available Color<span style="color: red">*</span></th>
                <td>
                    <select class="form-control" name="hex">
                        <option value="008000" @if(old('hex', $lot->hex) == "008000") selected @endif>Green</option>
                        <option value="ff0000" @if(old('hex') == "ff0000") selected @endif)>Red</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Status<span style="color: red">*</span></th>
                <td>
                    <select class="form-control" name="status">
                        <option value="1" @if(old('status', $lot->status) == "1") selected @endif>Available</option>
                        <option value="0" @if(old('status') == "0") selected @endif)>Not Available</option>
                    </select>
                </td>
            </tr>
        </table>
        <a href="{{ route('app.admin.lot.index') }}" class="btn btn-info">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection