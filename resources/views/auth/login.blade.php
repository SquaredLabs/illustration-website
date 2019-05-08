@extends('layouts.app')

@section('content')
<div class="login container">
<form method="POST" action="{{ route('login') }}">
    @csrf
    <h1>Login</h1>
    <button class="netid"><a href="/logincas">Login with netID Single Sign On</a></button>
</form>
@endsection
