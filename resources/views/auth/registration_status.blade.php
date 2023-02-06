@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">Welcome to RAG43 Election</h2>
                <h5 id="thank" class="text-center">Thank you for your registration.</h5>
                <div class="card mt-4" style="background: #d5eadb">
                    <div class="card-header text-center">Voter Information</div>

                    <div class="card-body">
                        <div class="image-show">
                            <img class="img-fluid" src="{{ url('storage/images/' . $user->thumb) }}">
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
                            <div class="d-flex justify-content-center">
                                <a href="/login" class="btn btn-success">LOGIN TO CHECK APPROVAL</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            setTimeout(removeText, 3000);
        }

        const removeText = () => {
            document.getElementById('thank').innerHTML = '';
        }
    </script>
@endsection
