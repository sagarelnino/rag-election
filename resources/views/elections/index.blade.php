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
                                                election_id={{ $election->id }} id="is_active"
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
    <form method="post" class="d-none" id="update_activity_form" action="/election_activity">
        @csrf
        <input type="text" name="election_id" value="">
        <input type="text" name="is_active" value="">
    </form>
    <script>
        let check_input = $("#is_active");
        check_input.on('change', function() {
            let check = confirm('Are you sure to change status?');
            if (check == true) {
                let is_active = this.checked;
                let election_id = this.getAttribute('election_id');
                $("input[name='election_id']").val(election_id);
                $("input[name='is_active']").val(is_active);
                $("#update_activity_form").submit();
            }
        })
    </script>
@endsection
