@extends('layouts.app')

@section('header-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <h1>Vue posts</h1>

        <div id="root">
            <div class="row">
                <div v-for="post in posts">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <h5 class="card-title">@{{ post.title }}</h5>
                        <p class="card-text">@{{ post.content }}</p>
                        {{-- <a href="" class="btn btn-primary">Vedi dettagli post</a> --}}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
    
@endsection