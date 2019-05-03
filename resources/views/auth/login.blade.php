@extends('layouts.app')

@section('content')
<div class="login container">
<form method="POST" action="{{ route('login') }}">
    @csrf
    <h1>Login</h1>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <input id="email" type="email" 
    class="form-control @error('email') is-invalid @enderror" 
    name="email" value="{{ old('email') }}" required 
    autocomplete="email" autofocus placeholder="Email">

    <input id="password" type="password" 
    class="form-control @error('password') is-invalid @enderror" 
    name="password" required autocomplete="current-password" 
    placeholder="Password">
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button type="submit" class="submit">
        {{ __('Login') }}
    </button>
    <div class="remember">
        <label for="remember">Remember me</label>
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    </div>
    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
    <button class="netid"><a href="/logincas">Login with netID</a></button>
</form>
@endsection
