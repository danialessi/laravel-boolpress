@extends ('layouts.app')

@section('content')
    <div class="container">
        
        <h2>{{ $post->title }}</h2>

        {{-- se la categoria è popolata stampala  --}}
        @if($post->category)
        <div class="mt-2 mb-2"><strong>Categoria: </strong>{{ $post->category->name }}</div>
        @endif

        <div class="mt-2 mb-2">
            <strong>Tags: </strong>
            @foreach($post_tags as $tag)
                {{ $tag->name }} {{ $loop->last ? '' : ', ' }}
            @endforeach
        </div>

        <div class="mt-2 mb-2"><strong>Slug: </strong>{{ $post->slug}}</div>

        <p>{{ $post->content }}</p>

        <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="mt-2 btn btn-secondary">Modifica Post</a>
    </div>
@endsection