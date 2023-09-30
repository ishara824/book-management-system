@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="{{ route('user.registration.ui') }}">Add User+</a>
            </div>
        </div>

        <table class="table table-responsive col-md-12 mt-4">
            <thead class="thead-dark">
            <tr>
                <th width="100">#</th>
                <th class="text-center" width="500">First Name</th>
                <th class="text-center" width="100">Last Name</th>
                <th class="text-center" width="200">Phone Number</th>
                <th class="text-center" width="400">Email</th>
                <th class="text-center" width="200">Type</th>
                <th class="text-center" width="400">Action</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 1; @endphp
            @foreach($users as $user)
                @foreach($user['readers'] as $reader)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $reader->first_name }}</td>
                        <td>{{ $reader->last_name }}</td>
                        <td>{{ $reader->phone_number }}</td>
                        <td>{{ $reader->email }}</td>
                        <td>Reader</td>
                        <td>
                            <button class="btn btn-success" onclick="activateReader({{$reader->id}})">Activate</button>
                            <button class="btn btn-danger" onclick="disableReader({{$reader->id}})">Disable</button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            @foreach($users as $user)
                @foreach($user['staffUsers'] as $staffUser)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $staffUser->first_name }}</td>
                        <td>{{ $staffUser->last_name }}</td>
                        <td>{{ $staffUser->phone_number }}</td>
                        <td>{{ $staffUser->email }}</td>
                        <td>Staff</td>
                        <td>
                            <button class="btn btn-success" onclick="activateStaffUser({{$staffUser->id}})">Activate</button>
                            <button class="btn btn-danger" onclick="disableStaffUser({{$staffUser->id}})">Disable</button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

<script>
    function activateReader(readerId)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/staff/activate-reader',
            type: 'post',
            data: {readerId: readerId},
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {
                    swal("Good job!", "User Activated!", "success");
                    // setTimeout(function (){
                    //     location.reload();
                    // },1000);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function disableReader(readerId)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/staff/disable-reader',
            type: 'post',
            data: {readerId: readerId},
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {
                    swal("Good job!", "User Disabled!", "success");
                    // setTimeout(function (){
                    //     location.reload();
                    // },1000);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function activateStaffUser(staffId)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/staff/activate-staff-user',
            type: 'post',
            data: {staffId: staffId},
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {
                    swal("Good job!", "User Activated!", "success");
                    // setTimeout(function (){
                    //     location.reload();
                    // },1000);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function disableStaffUser(staffId)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/staff/disable-staff-user',
            type: 'post',
            data: {staffId: staffId},
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {
                    swal("Good job!", "User Disabled!", "success");
                    // setTimeout(function (){
                    //     location.reload();
                    // },1000);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

</script>
