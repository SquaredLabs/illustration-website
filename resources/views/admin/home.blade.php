@extends('layouts.app')

@section('content')
<div class="admin home">
    <button class="adminLink"><a href="/admin/requests">View Requests</a></button>
    <button class="adminLink"><a href="/admin/illustration">Edit Illustration Portfolio</a></button>
    <button class="adminLink"><a href="/admin/new">Add Administrator</a></button>
    <button class="adminLink"><a href="/api/users">View Users</a></button>
</div>
@endsection
