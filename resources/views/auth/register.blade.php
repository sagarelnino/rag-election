@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">Welcome to RAG43 Election</h2>
                <div class="card mt-4" style="background: #d5eadb">
                    <div class="card-header">Register as a voter</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="hall" class="col-md-4 col-form-label text-md-end">Hall</label>

                                <div class="col-md-6">
                                    <select id="hall" class="form-control @error('hall') is-invalid @enderror"
                                        name="hall" required autofocus>
                                        <option value="">Select Hall</option>
                                        @if (count($halls) > 0)
                                            @foreach ($halls as $hall)
                                                <option value="{{ $hall->hall }}">{{ $hall->hall }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('hall')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="department" class="col-md-4 col-form-label text-md-end">Department</label>

                                <div class="col-md-6">
                                    <select id="department" class="form-control @error('department') is-invalid @enderror"
                                        name="department" required autofocus>
                                        <option value="">Select Department</option>
                                        @if (count($departments) > 0)
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->department }}">{{ $department->department }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">Present Address</label>

                                <div class="col-md-6">
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required>{{ old('address') }}</textarea>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="home_district" class="col-md-4 col-form-label text-md-end">Home District</label>

                                <div class="col-md-6">
                                    <input id="home_district" type="text"
                                        class="form-control @error('home_district') is-invalid @enderror"
                                        name="home_district" value="{{ old('home_district') }}" required
                                        autocomplete="home_district">

                                    @error('home_district')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="thumb" class="col-md-4 col-form-label text-md-end">Image</label>

                                <div class="col-md-6">
                                    <input id="thumb" type="file"
                                        class="form-control @error('thumb') is-invalid @enderror" name="thumb"
                                        value="{{ old('thumb') }}" accept="image/png, image/jpeg, image/jpg">

                                    @error('thumb')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="facebook_id" class="col-md-4 col-form-label text-md-end">Facebook Id</label>

                                <div class="col-md-6">
                                    <input id="facebook_id" type="url"
                                        class="form-control @error('facebook_id') is-invalid @enderror" name="facebook_id"
                                        value="{{ old('facebook_id') }}" accept="image/png, image/jpeg, image/jpg">

                                    @error('facebook_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-0 mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <p>Already Registered?</p>
                                    <a href="{{ url('/login') }}" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
