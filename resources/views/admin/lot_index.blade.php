@extends('layouts.mytemplate_system')

@section('pagetitle')
Admin Lot
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    List of All Lots
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Manage Lot</li>
    @endsection
    <div class="card-body mt-4">
        <a href="{{ route('app.admin.lot.create') }}" class="btn btn-primary">Create Lot</a>
        
        <table class="table">
            <tr>
                <th>No</th><th>Name</th><th>Size</th><th>Capacity</th><th>Facilities</th><th>Price</th><th>Photo</th><th>Status</th><th>Action</th>
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
                    <img src="{{ asset('uploads/lots/'.$lot->photo) }}" style="width:100px;">
                    @endif
                </td>
                <td>
                    @if($lot->status=="1")
                    <span class="badge bg-success">Available</a></td>
                    @else
                    <span class="badge bg-danger">Unavailable</a></td>
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" onclick="editFx('{{ $lot->id }}')">Edit</a>
                    <form action="{{ route('app.admin.lot.destroy', $lot->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="showDeleteAlert()">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $lots->appends($_GET)->render() !!}
    </div>
</div>
<script type="text/javascript">
function editFx(id){
    if (confirm("Are you sure to edit your lot?")) {
        window.location.href = "{{ url('app/admin/lot') }}/" + id + "/edit";
    } else {
        window.location.href = "{{ route('app.admin.lot.index') }}";
    }
  }

  function showDeleteAlert() {
    alert("Please note that you are about to delete this lot.");
  }
</script>
@endsection