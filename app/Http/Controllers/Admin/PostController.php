<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // con questa funzione devo prendere dal model (con una query) tutti i post che devono poi essere gestiti come amministratore
        // return: la view con nome index contenuta nella cartella admin delle views
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        $data = [
            'categories' => $categories
        ];

        // return: la view con il form
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazione
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        // con questa funzione ricevo i dati dal form contenuto in create (attraverso $request) e li salvo in una variabile
        // return: la view relativa al post appena creato 
        $form_data = $request->all();

        // CREAZIONE SLUG
        // slug del post creato 
        $new_slug = Str::slug($form_data['title'], '-');
        $base_slug = $new_slug;

        // con questa query controllo che non esista già uno slug uguale 
        $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        $counter = 1;

        // attraverso un ciclo, nel caso in cui trovassi uno slug uguale, allo slug di base aggiungo un numero (counter)
        while($existing_post_with_slug) {
            $new_slug = $base_slug . '-' . $counter;
            // provo con un altro slug 
            $counter++;

            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        }

        $form_data['slug'] = $new_slug;

        // in questa variabile aggiungo una nuova istanza di Post (corrispondente ad una nuova riga nel DB)
        $new_post = new Post();

        // salvo i dati nel database
        $new_post->fill($form_data);
        $new_post->save();

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // con questa funzione devo ricavare dal model (con una query) il singolo post da gestire poi come amministratore. Lo cerco tramite id.
        // return: la view con nome show contenuta nella cartella admin delle views
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // con questa funzione si ricava il post tramite id per andarlo a modificare
        // return: la view con il form di modifica del post 
        $post = Post::findOrFail($id);
        $categories = Category::all();

        $data = [
            'post' => $post,
            'categories' => $categories
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validazione
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        // devo richiamare i dati del form del post modificato su create 
        $form_data = $request->all();

        // richiamo il post da modificare tramite id
        $post_to_modify = Post::find($id);

        // di default lo slug non cambia se non cambia il titolo
        $form_data['slug'] = $post_to_modify->slug;

        if($form_data['title'] != $post_to_modify->title) {
            $new_slug = Str::slug($form_data['title'], '-');
            $base_slug = $new_slug;

            // con questa query controllo che non esista già uno slug uguale 
            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
            $counter = 1;

            // attraverso un ciclo, nel caso in cui trovassi uno slug uguale, allo slug di base aggiungo un numero (counter)
            while($existing_post_with_slug) {
                $new_slug = $base_slug . '-' . $counter;
                // provo con un altro slug 
                $counter++;

                $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
            }

            $form_data['slug'] = $new_slug;
        }

        // aggiorno i dati del post con quelli del form
        $post_to_modify->update($form_data);

        return redirect()->route('admin.posts.show', ['post' => $post_to_modify->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ricavo il post da eliminare tramite id
        $post_to_delete = Post::find($id);

        // gli aggiungo il metodo delete
        $post_to_delete->delete();

        return redirect()->route('admin.posts.index');
    }
}
