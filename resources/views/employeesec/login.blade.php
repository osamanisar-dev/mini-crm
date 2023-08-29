@extends('layouts.employee-app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @elseif(Session::has('password-reset-success'))
                <div class="alert alert-success">{{Session::get('password-reset-success')}}</div>
            @endif

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Employee {{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('employee.auth') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email or Username') }}</label>

                                <div class="col-md-6">
                                    <input id="email" class="form-control" name="login">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.reset-otp'))
                                        <a class="btn btn-link" href="{{ route('password.reset-otp') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
