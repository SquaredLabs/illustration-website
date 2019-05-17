@extends('layouts.app')
@section('content')
<div id="app" class="manageusers">
    @csrf
    <v-user-manage/>
</div>
@endsection
