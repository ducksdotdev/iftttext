@extends('layouts.app')

@section('content')
    <div id="login">
        <form method="POST" action="{{ route('register') }}">
            <h2>Register</h2>
            @csrf
            <div class="form-group">
                <label>Email
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                </label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <label>Phone
                    <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                </label>
                @if ($errors->has('phone'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label>Password
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    </label>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label>Confirm Password
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </label>
            </div>
            <div class="form-group actions">
                <a href="{{ route('login') }}">Back to Login</a>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
@endsection
