@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        SUMMARY
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Active Elections: {{ isset($elections) ? $elections : 0 }}</li>
                            <li>Candidates: King(2), Queen(2)</li>
                            <li>Voters: {{ isset($voters) ? $voters : 0 }}</li>
                            <li>Waiting for approval: {{ isset($approvals) ? $approvals : 0 }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
