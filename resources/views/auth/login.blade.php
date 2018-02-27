@extends('layouts.app')

@section('content')
    <div id="login">
        <form method="POST" action="{{ route('login') }}">
            <h2>IFTTTEXT Login</h2>
            @csrf
            <div class="form-group">
                <label>Email
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email@example.com" required autofocus>
                </label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <label>Password
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="********" required>
                </label>
                @if ($errors->has('password'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>
            <div class="form-group actions">
                <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span>Remember Me</span></label>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="form-group">
                <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>
        </form>
        <a href="{{ route('register') }}" class="sign-up">Not a member? Click here to register.</a>
    </div>
@endsection
