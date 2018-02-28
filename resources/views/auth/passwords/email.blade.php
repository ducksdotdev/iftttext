@extends('layouts.app')

@section('content')
    <div id="login">
        <form method="POST" action="{{ route('password.email') }}">
            <h2>Reset Password</h2>
            @csrf
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Email
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email@example.com" required>
                </label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="form-group actions">
                <a href="{{ route('home') }}">Back to login</a>
                <button type="submit" class="btn btn-primary">Reset</button>
            </div>
        </form>
    </div>
@endsection
