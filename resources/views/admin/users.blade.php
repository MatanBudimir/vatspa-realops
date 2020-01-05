@extends('landing')

@section('title', 'Users')

@section('content')
<section id="about" style="width: 75%; margin-left: auto; margin-right: auto;">
    <h2 style="text-align: center;">All users</h2>
<table id="usersTable" class="table" style="width:100%; word-break: break-all; text-align: center;">
    <thead>
        <tr>
            <th>VATSIM ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Flights</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->full() }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if (App\Models\Booking::where('user_id', $user->id)->count() <= 0)
                    {{ App\Models\Booking::where('user_id', $user->id)->count() }}
                @else
                    <p>
                        {{ App\Models\Booking::where('user_id', $user->id)->count() }}
                    </p>
                @endif
            </td>
            <td>
                <form method="POST" action="{{ route('admin.user.edit') }}">
                    @csrf
                    <input hidden value="{{ $user->id }}" name="cid">
                <select class="form-control" name="role">
                    <option @if ($user->access_level == false) selected @endif value="0">Member</option>
                    <option @if ($user->access_level == true) selected @endif value="1">Admin</option>
                </select>
            </td>
            <td><button class="btn btn-danger">Edit</button></td></form>
        </tr>
        @endforeach
    </tbody>
</table>
</section>
@endsection

@section('scripts')
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<script>
$(document).ready( function () {
    $('#usersTable').DataTable();
} );
</script>
@endsection
