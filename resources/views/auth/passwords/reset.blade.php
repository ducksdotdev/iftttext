@extends('layouts.app')

@section('content')
    <div id="login">
        <form method="POST" action="{{ route('password.request') }}">
            <h2>Reset Password</h2>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label>Email
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>
                </label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <label>Password
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                </label>
                @if ($errors->has('password'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <label>Confirm Password
                    <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                </label>
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                @endif
            </div>
            <div class="form-group actions">
                <a href="{{ route('home') }}">Back</a>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>
    </div>
@endsection
