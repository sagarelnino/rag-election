@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center">Add Election</h3>
                <div class="alert alert-warning" role="alert">
                    The kings and queens have already been set. Just add the election settings.
                </div>
                <div class="card mt-4" style="background: #d5eadb">
                    <div class="card-header">Add the information below</div>

                    <div class="card-body">
                        <form method="POST" action="/election">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title') }}" placeholder="Enter a title for this election" required
                                        autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="start_time" class="col-md-4 col-form-label text-md-end">Starts on</label>

                                <div class="col-md-6">
                                    <input id="start_time" type="datetime-local" value="{{ old('start_time') }}"
                                        class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                                        required autocomplete="start_time">

                                    @error('start_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="end_time" class="col-md-4 col-form-label text-md-end">Ends on</label>

                                <div class="col-md-6">
                                    <input id="end_time" type="datetime-local" value="{{ old('end_time') }}"
                                        class="form-control @error('end_time') is-invalid @enderror" name="end_time"
                                        required autocomplete="end_time">

                                    @error('end_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
