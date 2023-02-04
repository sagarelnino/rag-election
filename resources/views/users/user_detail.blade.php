@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    @if ($user->is_approved == true)
                        <button onclick="changeStatus('decline')" class="btn btn-danger">Decline</button>
                    @else
                        <button onclick="changeStatus('approve')" class="btn btn-success">Approve</button>
                    @endif
                </div>
                <div class="card mt-4" style="background: #d5eadb">
                    <div class="card-header text-center">Voter Information</div>

                    <div class="card-body">
                        <div class="image-show">
                            <img src="{{ url('storage/images/' . $user->thumb) }}">
                        </div>
                        <div class="info">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Fullname</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Approval Status</th>
                                        <th>
                                            @if ($user->is_approved == true)
                                                <p class="text-success">Approved
                                                <p>
                                                @elseif ($user->is_approved == false)
                                                <p class="text-danger">Not Approved yet
                                                <p>
                                            @endif

                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Hall</th>
                                        <td>{{ $user->hall }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Department</th>
                                        <td>{{ $user->department }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td>{{ $user->address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Home District</th>
                                        <td>{{ $user->home_district }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Facebook Id</th>
                                        <td><a target="_blank" href="{{ $user->facebook_id }}">{{ $user->facebook_id }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button onclick="deleteUser()" id="delete" class="btn btn-warning">Delete Voter</button>
                </div>
            </div>
        </div>
    </div>
    <form id="approval_form" method="post" class="d-none" action="/update_approval/{{ $user->id }}">
        @csrf
        <input type="text" name="status" value="">
    </form>
    <form id="delete_form" method="post" class="d-none" action="/delete_user/{{ $user->id }}">
        @csrf
        @method('delete')
    </form>
    <script>
        function changeStatus(param) {
            let msg = '';
            if (param == 'decline') {
                msg = 'Are you sure to decline?'
            } else if (param == 'approve') {
                msg = 'Are you sure to approve?'
            }

            let check = confirm(msg);
            if (check == true) {
                document.querySelector("input[name='status']").value = param;
                document.getElementById('approval_form').submit();
            }
        }

        function deleteUser() {
            let check = confirm('Are you confirm to delete this user?');
            if (check == true) {
                document.getElementById('delete_form').submit();
            }
        }
    </script>
@endsection
