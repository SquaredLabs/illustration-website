    
@extends('layouts.app')
@section('content')
<div id="app" class="illustrations">

    @csrf
    <v-illustration-sample-form></v-illustration-sample-form>
    <v-portfolio-preview></v-portfolio-preview>
</div>
@endsection
