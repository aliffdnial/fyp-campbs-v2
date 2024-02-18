@extends('layouts.mytemplate')

@section('pagetitle')
Camper Lot
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    List of Lots
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper View Lot</li>
    @endsection
    <div class="card-body mt-4">
        <table class="table">
            <tr>
                <th>No</th><th>Name</th><th>Size</th><th>Capacity</th><th>Facilities</th><th>Lot Price</th><th>Photo</th><th>Status</th>
            </tr>
            @foreach($lots as $lot)
            <tr>
                <td>{{ $lot->id }}</td>
                <td>{{ $lot->name }}</td>
                <td>{{ $lot->size }}</td>
                <td>{{ $lot->capacity }}</td>
                <td>{{ $lot->facilities }}</td>
                <td>RM {{ $lot->price }}</td>
                <td>
                    @if($lot->photo)
                    <img src="{{ asset('uploads/lots/'.$lot->photo) }}" style="width:300px;">
                    @endif
                </td>
                <td>
                    @if($lot->status == "1")
                        <span class="badge bg-success">Available</a></td>
                    @else
                        <span class="badge bg-danger">Unavailable</a></td>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        {!! $lots->appends($_GET)->render() !!}
    </div>
</div>
@endsection