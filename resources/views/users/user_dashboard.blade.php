@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($user->is_approved == false)
                    <div class="alert alert-warning" role="alert">
                        You can not browse anything else until you are not approved
                    </div>
                @endif
                <div class="card mt-4" style="background: #d5eadb">
                    <div class="card-header text-center">Your Information</div>

                    <div class="card-body">
                        <div class="image-show">
                            <img class="img-fluid" src="{{ url('storage/images/' . $user->thumb) }}">
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
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-success" href="/elections">Elections</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
