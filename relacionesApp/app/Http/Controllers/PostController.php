<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //retorna un view con datos post
        return view("post.index", [
            'posts' => Post::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //retorna de view de vista blade
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate y try catch
        $validated = $request->validate([
            'title' => 'required|string|min:25|max:60|unique:posts',
            'entry' => 'required|string|min:60|max:250|unique:posts',
            'text' => 'required|string|min:100'
        ]);

        $post = new Post($validated);
        try {
            $post->text = strip_tags($post->text, env('PERMITTED_TAGS', ''));
            $post->save();
            return redirect('/')->with(['message'=> 'La noticia se ha creado existosamente']);
        }catch(\Exception $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //retora
        $post = Post::find($id);
        if($post){
            return view('post.show', ['post' => $post]);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //retorna de view de vista balde de un post
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //validate y try catch con update
        $validated = $request->validate([
            'title' => 'required|string|min:25|max:60|unique:posts,title,' . $post->id,
            'entry' => 'required|string|min:60|max:250|unique:posts,entry,' . $post->id,
            'text' => 'required|string|min:100'
        ]);

        try {   
            $post->update($validated);
            
            /*$post->fill($validated);
            $post->save(); */

            return redirect('/post/' . $post->id)->with(['message' => 'La noticia ha sido actualizada']);
        }catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //try catch con delete
    }

    function storeComment(Request $request, Post $post) {
        $validated = $request->validate([
            'mail' => 'required|string|min:5|max:40|unique:comments',
            'nickname' => 'required|string|min:5|max:100|unique:comments',
            'text' => 'required|string|min:10'
        ]);
        $comment = new Comment($validated);
        $comment->post_id = $post->id;
        try {
            $comment->save();
            return back()->with(['message'=> 'El comentario se ha creado exitosamente']);
        }catch(\Exception $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
}
