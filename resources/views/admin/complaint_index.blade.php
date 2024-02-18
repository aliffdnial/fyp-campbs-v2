@extends('layouts.mytemplate_system')

@section('pagetitle')
Admin Complaint
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    List of All Complaints
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Manage Complaint</li>
    @endsection
    <div class="card-body mt-4">
    
        <table>
            <tr>
                <td><input type="text" class="form-control" name="search" id="search" value="{{ $search }}" placeholder="Search by Name ..." title="Search by Name ..."></td>
                <td><button type="button" class="btn btn-primary" name=""  onclick="search()">Search</button></td>
                
                <td><input type="date" class="form-control" name="search1" id="search1" value="{{ $search1 ? date('d-m-Y', strtotime($search1)) : '' }}" title="Search Created At"></td>
                <td><button type="button" class="btn btn-info" name="search1" id="search1"  onclick="search1()">Search</button></td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <th>No</th><th>Name</th><th>Title</th><th>Description</th><th>Suggestion</th><th>Photo</th><th>Created At</th><th>Status</th><th>Action</th>
            </tr>
            @foreach($complaints as $complaint)
            <tr>
                <td>{{ $complaint->id }}</td>
                <td>{{ $complaint->user->name }}</td>
                <td>{{ $complaint->title }}</td>
                <td>{{ $complaint->description }}</td>
                <td>{{ $complaint->suggestion }}</td>
                <td>
                    @if($complaint->photo)
                    <img src="{{ asset('uploads/complaints/'.$complaint->photo) }}" style="width:100px;">
                    @endif
                </td>
                <td>{{ date('d-m-Y', strtotime($complaint->created_at)) }}</td>
                <td>
                    @if($complaint->status == "0")
                        <span class="badge bg-secondary">Under Review</a></td>
                    @elseif($complaint->status == "1")
                        <span class="badge bg-success">Solved</a></td>
                    @else
                        <span class="badge bg-danger">Rejected</a></td>
                    @endif
                </td>
                <td>
                    <form action="{{ route('app.admin.complaint.update', $complaint->id) }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        @if ($complaint->status == 1) <!-- Status Solved -->
                            <button type="submit" name="action" value="solve" class="btn btn-success btn-sm" disabled>Solved</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm" disabled>Reject</button>
                        @elseif ($complaint->status == 2) <!-- Status Reject  -->
                            <button type="submit" name="action" value="solve" class="btn btn-success btn-sm" disabled>Solved</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm" disabled>Reject</button>
                        @else
                            <button type="submit" name="action" value="solve" class="btn btn-success btn-sm" onclick="showSolvedAlert()">Solved</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm" onclick="showRejectAlert()">Reject</button>
                        @endif
                    </form>
                    <form action="{{ route('app.admin.complaint.destroy', $complaint->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm" onclick="showDeleteAlert()">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<script type="text/javascript">
function search(){
    var search = document.getElementById('search').value;
    self.location = '{{ route('app.admin.complaint.index') }}?search='+search;
}

function search1(){
    var createdAt = document.getElementById('search1').value;
    self.location = '{{ route('app.admin.complaint.index') }}?search1='+createdAt;
}

function showSolvedAlert() {
    alert("Please note that you are about to solved this complaint.");
}
function showRejectAlert() {
    alert("Please note that you are about to reject this complaint.");
}
function showDeleteAlert() {
    alert("Please note that you are about to delete this complaint.");
}
</script>

@endsection