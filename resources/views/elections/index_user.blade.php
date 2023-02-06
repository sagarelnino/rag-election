@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">On Going elections</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Start time</th>
                            <th scope="col">End time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elections as $election)
                            @if ($election->is_active == true)
                                <tr>
                                    <td>{{ $election->title }}</td>
                                    <td>{{ $election->start_time }}</td>
                                    <td>{{ $election->end_time }}</td>
                                    <td>
                                        <a href="/election/{{ $election->id }}" class="btn btn-sm btn-info">VOTE</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
