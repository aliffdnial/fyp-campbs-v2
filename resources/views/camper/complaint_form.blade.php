@extends('layouts.mytemplate')

@section('pagetitle')
Camper Complaint Form
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    Complaint Details
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper Complaint Form</li>
    @endsection
    <div class="card-body mt-4">
        @if($complaint->id)<!-- TO CHECK id ALREADY EXIST OR NOT -->
        <form action="{{ route('app.complaint.update', $complaint->id) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" >
        @else
        <form action="{{ route('app.complaint.store') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf

        <table class="table">
            <tr>
                <th>Title <span style="color: red">*</span></th>
                <td>
                    <select class="form-control" name="title">
                       <option value="Complaint" @if(old('title', $complaint->title) == "complaint") selected @endif)>Complaint</option>
                       <option value="Improvement" @if(old('title') == "improvement") selected @endif)>Improvement</option>
                    </select>
                    @error('title')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Description <span style="color: red">*</span></th>
                <td>
                    <input type="text" class="form-control" name="description" value="{{ old('description', $complaint->description) }}">
                    @error('description')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Suggestion<span style="color: red">*</span></th>
                <td>
                    <input type="text" class="form-control" name="suggestion" value="{{ old('suggestion', $complaint->suggestion) }}">
                    @error('suggestion')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Prove/Evidence</th>
                <td>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
        </table>
        <a href="{{ route('app.complaint.index') }}" class="btn btn-info">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection