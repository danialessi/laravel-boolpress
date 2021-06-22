@extends ('layouts.app')

@section('content')
    <div class="container">
        
        <h2>{{ $post->title }}</h2>

        {{-- se la categoria è popolata stampala  --}}
        @if($post->category)
        <h5>Categoria: {{ $post->category->name }}</h5>
        @endif

        <div class="mt-3 mb-3"><strong>Slug: </strong>{{ $post->slug}}</div>

        <p>{{ $post->content }}</p>

        <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="mt-2 btn btn-secondary">Modifica Post</a>
    </div>
@endsection