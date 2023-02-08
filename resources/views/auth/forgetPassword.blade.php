@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4" style="background: #d5eadb">
                    <div class="card-header">Reset Password</div>

                    <div class="card-body">
                        <form action="{{ route('forget.password.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-end">E-Mail
                                    Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required
                                        autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-4 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (Session::has('message'))
                    <div class="alert alert-warning" role="alert">
                        Check your spam folder too for reset link
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
