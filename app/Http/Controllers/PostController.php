<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('guest.posts.index', $data);
    }

    public function show($slug) {
        $post = Post::where('slug', '=', $slug)->first();

        $data = [
            'post' => $post
        ];

        return view('guest.posts.show', $data);
    }

    public function vuePosts() {
        return view('guest.posts.vue-posts');
    }
}
