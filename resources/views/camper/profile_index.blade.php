@extends('layouts.mytemplate')

@section('pagetitle')
Camper Profile
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    My Profile
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper Profile</li>
    @endsection
    <div class="card-body mt-4">
        <table class="table">
            <tr>
                <th>Name</th><th>Address</th><th>Phone Number</th><th>Email</th><th>Updated At</th><th>Created At</th><th>Action</th>
            </tr>
            @foreach($profiles as $profile)
            <tr>
                <td>{{ $profile->name }}</td>
                <td>{{ $profile->address }}</td>
                <td>{{ $profile->phonenum }}</td>
                <td>{{ $profile->email }}</td>
                <td>{{ $profile->updated_at }}</td>
                <td>{{ $profile->created_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" onclick="editFx('{{ $profile->id }}')">Edit</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script type="text/javascript">
function editFx(id){
    if (confirm("Are you sure to edit your profile?")) {
        window.location.href = "{{ url('app/profile') }}/" + id + "/edit";
    } else {
        window.location.href = "{{ route('app.profile.index') }}";
    }
}
</script>
@endsection