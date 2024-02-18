@extends('layouts.mytemplate_system')

@section('pagetitle')
Admin Register
@endsection

@section('content')
<div class="card"><br>
    @section('pageheader')
    List of All Campers
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Manage Camper</li>
    @endsection
    <div class="card-body mt-4">

        <table>
            <tr>
                <td><a href="{{ route('app.admin.camper.create') }}" class="btn btn-primary">Create Camper</a>
                </td>
                <td><input type="text" class="form-control" name="search" id="search" value="{{ $search }}" placeholder="Search by Name ..." title="Search by Name ..."></td>
                <td><button type="button" class="btn btn-primary" name=""  onclick="search()">Search</button></td>
                
                <td><input type="date" class="form-control" name="search1" id="search1" value="{{ $search1 ? date('d-m-Y', strtotime($search1)) : '' }}" title="Search Created At"></td>
                <td><button type="button" class="btn btn-info" name="search1" id="search1"  onclick="search1()">Search</button></td>
            </tr>
        </table>
        
        <table class="table">
            <tr>
                <th>No</th><th>Name</th><th>Address</th><th>Phone Number</th><th>Email</th><th>Updated At</th><th>Created At</th><th>Role</th><th>Action</th>
            </tr>
            @foreach($campers as $camper)
            <tr>
                <td>{{ $camper->id }}</td>
                <td>{{ $camper->name }}</td>
                <td>{{ $camper->address }}</td>
                <td>{{ $camper->phonenum }}</td>
                <td>{{ $camper->email }}</td>
                <td>{{ date('d-m-Y', strtotime($camper->updated_at)) }}</td>
                <td>{{ date('d-m-Y', strtotime($camper->created_at)) }}</td>
                <td>
                @if($camper->usertype=="0")
                    <span class="badge bg-primary">User</a></td>
                @else
                    <span class="badge bg-danger">Admin</a></td>
                @endif
                </td>
                <td>
                    @if($camper->usertype=="0")
                        <a class="btn btn-primary btn-sm btn-lg disabled" role="button" aria-disabled="true" onclick="editFx('{{ $camper->id }}')">Edit</a>
                    @else
                        <a class="btn btn-primary btn-sm" onclick="editFx('{{ $camper->id }}')">Edit</a>
                    @endif
               
                    @if($camper->usertype=="0")
                        <form action="{{ route('app.admin.camper.destroy', $camper->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                    @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="showDeleteAlert()">Delete</button>
                    @else
                        <button type="submit" class="btn btn-warning btn-sm">Forbidden</button>
                    @endif
                        </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $campers->appends($_GET)->render() !!}
    </div>
</div>

<script type="text/javascript">
function search(){
    var search = document.getElementById('search').value;
    self.location = '{{ route('app.admin.camper.index') }}?search='+search;
}

function search1(){
    var createdAt = document.getElementById('search1').value;
    self.location = '{{ route('app.admin.camper.index') }}?search1='+createdAt;
}

function editFx(id){
    if (confirm("Are you sure to edit this profile?")) {
        window.location.href = "{{ url('app/admin/camper') }}/" + id + "/edit";
    } else {
        window.location.href = "{{ route('app.admin.camper.index') }}";
    }
}

function showDeleteAlert() {
    alert("Please note that you are about to delete this camper.");
}
</script>
@endsection