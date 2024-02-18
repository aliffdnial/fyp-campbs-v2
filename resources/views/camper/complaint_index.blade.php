@extends('layouts.mytemplate')

@section('pagetitle')
Camper Complaint
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    List of My Complaint
    @endsection

    @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Camper Complaint</li>
    @endsection
    <div class="card-body mt-4">
        <a href="{{ route('app.complaint.create') }}" class="btn btn-primary">Create New Complaint</a><br>
        <table class="table">
            <tr>
                <th>No</th><th>Date</th><th>Camper Name</th><th>Title</th><th>Description</th><th>Suggestion</th><th>Photo</th><th>Status</th><th>Action</th>
            </tr>
            @php($i=1)
            @foreach($complaints as $complaint)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ date('d-m-Y', strtotime($complaint->created_at)) }}</td>
                <td>{{ $complaint->user->name }}</td>
                <td>{{ $complaint->title }}</td>
                <td>{{ $complaint->description }}</td>
                <td>{{ $complaint->suggestion }}</td>
                <td>
                    @if($complaint->photo)
                        <img src="{{ asset('uploads/complaints/'.$complaint->photo) }}" style="width:100px;">
                    @endif
                </td>
                <td>
                    @if($complaint->status == 0)
                        <span class="badge bg-warning">Under Review</a></td>
                    @elseif($complaint->status == 1)
                        <span class="badge bg-success">Solved</a></td>
                    @else
                        <span class="badge bg-danger">Rejected</a></td>
                    @endif
                </td>
                <td>
                    @if($complaint->status == 1 || $complaint->status == 2) <!-- Status Solved, Rejected -->
                    <a href="{{ route('app.complaint.edit', $complaint->id) }}" class="btn btn-primary btn-sm btn-lg disabled" role="button" aria-disabled="true">Edit</a>
                    
                    <form action="{{ route('app.complaint.destroy', $complaint->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="showDeleteAlert()">Delete</button>
                    </form>
                    @else
                    @if(count($complaints) > 0)
                        <a class="btn btn-primary btn-sm" onclick="editFx('{{ $complaint->id }}')">Edit</a>
                    @else
                        <!-- Handle the case where there are no complaints -->
                        <p>No complaints available.</p>
                    @endif
                    
                    <form action="{{ route('app.complaint.destroy', $complaint->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="showDeleteAlert()">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script type="text/javascript">
function editFx(id){
    if (confirm("Are you sure to edit your complaint?")) {
        window.location.href = "{{ url('app/complaint') }}/" + id + "/edit";
    } else {
        window.location.href = "{{ route('app.complaint.index') }}";
    }
  }

function showDeleteAlert() {
    alert("Please note that you are about to delete your complaint.");
    }
</script>
@endsection