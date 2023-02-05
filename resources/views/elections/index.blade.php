@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">Election List</h3>
                <div class="d-flex justify-content-center mt-1 mb-2">
                    <a class="btn btn-success" href="/election/create">Add New Election</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Start time</th>
                            <th scope="col">End time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elections as $election)
                            <tr>
                                <th scope="row">{{ $election->id }}</th>
                                <td>{{ $election->title }}</td>
                                <td>{{ $election->start_time }}</td>
                                <td>{{ $election->end_time }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked"
                                                {{ $election->is_active == true ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="/election/{{ $election->id }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
