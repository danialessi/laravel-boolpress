@extends ('layouts.app')

@section('content')
    <div class="container">
        {{-- se la categoria è popolata stampala  --}}
        @if($post->category)
        <h5>Categoria: {{ $post->category->name }}</h5>
        @endif

        <h1>{{ $post->title }}</h1>

        <p>{{ $post->content}} </p>
    </div>
@endsection