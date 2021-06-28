@extends ('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica post: {{ $post->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
            </div>

            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">-</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <h6>Tags</h6>

                @foreach($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="tag-{{$tag->id}}" {{$post->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                </div>
                @endforeach

            </div>

            <div class="form-group">
                <label for="cover-image">Immagine</label>
                <input type="file" class="form-control-file" name="cover-image" id="cover-image">
            </div>

            @if ($post->cover)
                <h4>Anteprima</h4>
                <img class="mb-2" src="{{ asset('storage/' . $post->cover)}}" alt="{{ $post->title }}">
            @endif

            <div>
                <input type="submit" class="btn btn-primary" value="Salva">
            </div>
        </form>
    </div>
@endsection