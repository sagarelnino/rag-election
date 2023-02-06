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

                <form method="post" action="/vote/{{ $election->id }}">
                    @csrf
                    <div class="mt-3">
                        <h4 class="text-center text-primary">Vote for Queen</h4>
                        <div class="d-flex justify-content-center candidates">
                            @foreach ($candidates as $candidate)
                                @if ($candidate->type == App\Models\Candidate::TYPE_QUEEN)
                                    <div class="vote-candidate">
                                        <div class="form-check">
                                            @if ($hasAlreadyVoted != true)
                                                <input class="form-check-input" type="radio" name="vote_queen"
                                                    id="vote_queen_{{ $candidate->id }}" value="{{ $candidate->id }}">
                                                <label class="form-check-label" for="vote_queen_{{ $candidate->id }}">
                                                    <b>Vote {{ $candidate->fullname }}</b>
                                                </label>
                                            @endif
                                        </div>
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ url('storage/candidates/' . $candidate->thumb) }}"
                                                class="card-img-top" alt="{{ $candidate->fullname }}">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">{{ $candidate->fullname }}</h5>
                                                <div class="card-text text-center">
                                                    <span>{{ $candidate->department }}</span><br>
                                                    <span>{{ $candidate->hall }}</span><br>
                                                    <span>{{ $candidate->home_district }}</span>
                                                </div>
                                                @if (App\lib\Common::isElectionEnded($election->id) == true)
                                                    <p class="text-center mt-3"><b>Total Votes: {{ $candidate->votes }}</b>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-3">
                        <h4 class="text-center text-primary">Vote for King</h4>
                        <div class="d-flex justify-content-center candidates">
                            @foreach ($candidates as $candidate)
                                @if ($candidate->type == App\Models\Candidate::TYPE_KING)
                                    <div class="vote-candidate">
                                        <div class="form-check">
                                            @if ($hasAlreadyVoted != true)
                                                <input class="form-check-input" type="radio" name="vote_king"
                                                    id="vote_king_{{ $candidate->id }}" value="{{ $candidate->id }}">
                                                <label class="form-check-label" for="vote_king_{{ $candidate->id }}">
                                                    <b>Vote {{ $candidate->fullname }}</b>
                                                </label>
                                            @endif
                                        </div>
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ url('storage/candidates/' . $candidate->thumb) }}"
                                                class="card-img-top" alt="{{ $candidate->fullname }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $candidate->fullname }}</h5>
                                                <div class="card-text pl-2 text-center">
                                                    <span>{{ $candidate->department }}</span><br>
                                                    <span>{{ $candidate->hall }}</span><br>
                                                    <span>{{ $candidate->home_district }}</span>
                                                </div>

                                                @if (App\lib\Common::isElectionEnded($election->id) == true)
                                                    <p class="text-center mt-3"><b>Total Votes: {{ $candidate->votes }}</b>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @if ($hasAlreadyVoted != true)
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-lg btn-success" onclick="vote()">SUBMIT VOTE</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    {{-- <form method="post" action="/vote" class="d-none">
        @csrf
        <input type="text" name="queen" value="">
        <input type="text" name="king" value="">
    </form> --}}
    <script>
        function vote() {
            let queen_vote = document.querySelector("input[name='vote_queen']").value;
            let king_vote = document.querySelector("input[name='vote_king']").value;
            console.log(queen_vote);
            console.log(king_vote);
        }
    </script>
@endsection
