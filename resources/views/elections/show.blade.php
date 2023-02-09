@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">Election Details</h3>
                <div class="d-flex justify-content-center my-2">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-dark"><b>Title: </b>{{ $election->title }}</li>
                        <li class="list-group-item list-group-item-dark"><b>Start Time: </b>{{ $election->start_time }}</li>
                        <li class="list-group-item list-group-item-dark"><b>End Time: </b>{{ $election->end_time }}</li>
                    </ul>
                </div>

                <div class="mt-3">
                    <h4 class="text-center text-primary">Kings</h4>
                    <div class="d-flex justify-content-center candidates">
                        @foreach ($candidates as $candidate)
                            @if ($candidate->type == App\Models\Candidate::TYPE_KING)
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ url('storage/candidates/' . $candidate->thumb) }}" class="card-img-top"
                                        alt="{{ $candidate->fullname }}">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $candidate->fullname }}</h5>
                                        <div class="card-text pl-2 text-center">
                                            <span>{{ $candidate->department }}</span><br>
                                        </div>

                                        @if (App\lib\Common::isElectionEnded($election->id) == true && $election->show_vote == true)
                                            <p class="text-center mt-3"><b>Total Votes: {{ $candidate->votes }}</b></p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="mt-3">
                    <h4 class="text-center text-primary">Queens</h4>
                    <div class="candidates">
                        @foreach ($candidates as $candidate)
                            @if ($candidate->type == App\Models\Candidate::TYPE_QUEEN)
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ url('storage/candidates/' . $candidate->thumb) }}" class="card-img-top"
                                        alt="{{ $candidate->fullname }}">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $candidate->fullname }}</h5>
                                        <div class="card-text text-center">
                                            <span>{{ $candidate->department }}</span><br>
                                        </div>
                                        @if (App\lib\Common::isElectionEnded($election->id) == true && $election->show_vote == true)
                                            <p class="text-center mt-3"><b>Total Votes: {{ $candidate->votes }}</b></p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <h4 class="text-center">VOTER LIST</h4>
                <div class="table-responsive">
                    <table class="table table-striped mt-3" style="background: #d5eadb">
                        <thead>
                            <tr>
                                <th scope="col">Fullname</th>
                                <th scope="col">Hall</th>
                                <th scope="col">Department</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_voted = 0; ?>
                            @foreach ($users as $user)
                                <?php
                                if ($user->cnt > 0) {
                                    $total_voted++;
                                }
                                ?>
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->hall }}</td>
                                    <td>{{ $user->department }}</td>
                                    <td>
                                        @if ($user->cnt == 0)
                                            <p class="text-danger">NOT VOTED YET</p>
                                        @else
                                            <p>Already Voted</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/user/{{ $user->id }}" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h1 class="text-center">TOTAL VOTE COUNTED: {{ $total_voted }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
