@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">Election List</h3>
                <div class="d-flex justify-content-center mt-1 mb-2">
                    <a class="btn btn-success" href="/election/create">Add New Election</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" style="background: #d5eadb">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Start time</th>
                                <th scope="col">End time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Vote Show</th>
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
                                                    onchange="changeActivity(this)" election_id={{ $election->id }}
                                                    id="is_active_{{ $election->id }}"
                                                    {{ $election->is_active == true ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    onchange="changeVoteShow(this)" election_id={{ $election->id }}
                                                    id="show_vote_{{ $election->id }}"
                                                    {{ $election->show_vote == true ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/election/{{ $election->id }}" class="btn btn-sm btn-info">View</a>
                                        <a href="/election/{{ $election->id }}/edit"
                                            class="btn btn-sm btn-secondary">Edit</a>
                                        <button class="btn btn-sm btn-danger" election_id={{ $election->id }}
                                            onclick="deleteElection(this)">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <form method="post" class="d-none" id="update_activity_form" action="/election_activity">
        @csrf
        <input type="text" name="election_id_activity" value="">
        <input type="text" name="is_active" value="">
    </form>

    <form method="post" class="d-none" id="update_show_vote_form" action="/election_vote_show">
        @csrf
        <input type="text" name="election_id_show_vote" value="">
        <input type="text" name="show_vote" value="">
    </form>

    <form method="post" class="d-none" id="delete_election" action="/election">
        @method('delete')
        @csrf
        <input type="text" name="election_id" value="">
    </form>
    <script>
        function changeActivity(e) {
            let check = confirm('Are you sure to change status?');
            if (check == true) {
                let is_active = e.checked;
                let election_id = e.getAttribute('election_id');
                $("input[name='election_id_activity']").val(election_id);
                $("input[name='is_active']").val(is_active);
                $("#update_activity_form").submit();
            }
        }

        function changeVoteShow(e) {
            let check = confirm('Are you sure to change vote show status?');
            if (check == true) {
                let show_vote = e.checked;
                let election_id = e.getAttribute('election_id');
                $("input[name='election_id_show_vote']").val(election_id);
                $("input[name='show_vote']").val(show_vote);
                $("#update_show_vote_form").submit();
            }
        }

        function deleteElection(e) {
            let check = confirm('Are you sure to delete this election?');
            if (check == true) {
                let election_id = e.getAttribute('election_id');
                $("input[name='election_id']").val(election_id);
                $("#delete_election").submit();
            }
        }
    </script>
@endsection
