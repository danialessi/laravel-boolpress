@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Homepage pubblica</h1>
        <a class="btn btn-primary" href="{{ route('blog') }}">Vai al blog</a>
    </div>
    
@endsection