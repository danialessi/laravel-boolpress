@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Homepage pubblica</h1>

        <h2>Elenco post</h2>

        <div class="row">
            @foreach($posts as $post)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">{{$post->title}}</h5>
                  <p class="card-text">{{$post->content}}</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
    
@endsection