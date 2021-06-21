@extends ('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $post->title }}</h2>

        <div class="mt-3 mb-3"><strong>Slug: </strong>{{ $post->slug}}</div>

        <p>{{ $post->content }}</p>
    </div>
@endsection