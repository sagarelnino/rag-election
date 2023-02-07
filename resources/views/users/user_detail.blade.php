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
                            <div class="list-group mb-3 text-center">
                                <li class="list-group-item list-group-item-action">Name :
                                    {{ $user->name }}</li>
                                <li class="list-group-item list-group-item-action">Email :
                                    {{ $user->email }}</li>
                                <li class="list-group-item list-group-item-action">Approval Status :
                                    @if ($user->is_approved == true)
                                        <p class="text-success">Approved
                                        <p>
                                        @elseif ($user->is_approved == false)
                                        <p class="text-danger">Not Approved yet
                                        <p>
                                    @endif
                                </li>
                                <li class="list-group-item list-group-item-action">Hall :
                                    {{ $user->hall }}</li>
                                <li class="list-group-item list-group-item-action">Department :
                                    {{ $user->department }}</li>
                                <li class="list-group-item list-group-item-action">Address :
                                    {{ $user->address }}</li>
                                <li class="list-group-item list-group-item-action">Home District :
                                    {{ $user->home_district }}</li>
                                <li class="list-group-item list-group-item-action">Facebook Id :
                                    <a href="{{ $user->facebook_id }}" target="_blank">{{ $user->facebook_id }}</a>
                                </li>
                            </div>
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
