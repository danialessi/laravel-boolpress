@extends ('layouts.app')

@section('content')
    <div class="container">
        <h2>Elenco post amministratore</h2>

        <div class="row">
            @foreach($posts as $post)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <img src="{{ asset('storage/' . $post->cover) }}" class="card-img-top" alt="{{ $post->title }}">
                <p class="card-text">{{ substr($post->content, 0, 80) }}...</p>
                <a href="{{ route('admin.posts.show', ['post' => $post->id ]) }}" class="btn btn-primary">Vedi dettagli post</a>
                <a href="{{ route('admin.posts.edit', ['post' => $post->id ]) }}" class="mt-1 btn btn-secondary">Modifica post</a>
                
                {{-- per il bottone "cancella" si deve creare un form travestito da button per potergli passare il metodo delete richiesto --}}
                <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('DELETE')

                <input type="submit" class="mt-1 btn btn-danger" value="Elimina post">
                </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection