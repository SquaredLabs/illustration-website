@extends('layouts.app')

@section('content')
<body>
    <div id="app">
        <v-portfolio-item 
        img="https://picsum.photos/200/300" 
        desc="description" 
        title="photo"/>
    </div>
    <script type="text/javascript" src="js/app.js"></script>
</body>
@endsection
