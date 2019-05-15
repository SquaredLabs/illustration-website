@extends('layouts.app')

@section('content')
<body>
    <div id="app">
        <h1>Request an Illustration</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <v-request-form/>
    </div>
</body>
@endsection
