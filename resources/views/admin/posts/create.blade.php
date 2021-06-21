@extends ('layouts.app')

@section('content')
    <div class="container">
        <h1>Crea nuovo post</h1>

        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
            </div>

            <input type="submit" class="btn btn-primary" value="Salva">
        </form>
    </div>
@endsection