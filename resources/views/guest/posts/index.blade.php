@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Elenco post</h2>

    <div class="row">
        @foreach($posts as $post)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ substr($post->content, 0, 80) }}...</p>
            <a href="{{ route('post-page', ['slug' => $post->slug]) }}" class="btn btn-primary">Vedi dettagli post</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection