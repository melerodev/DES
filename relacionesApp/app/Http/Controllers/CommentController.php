<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mail' => 'required|string|min:5|max:40|unique:comments',
            'nickname' => 'required|string|min:5|max:100|unique:comments',
            'text' => 'required|string|min:10'
        ]);
        
        if (Post::find($request->post_id) === null) {
            abort(404);
        }

        $comment = new Comment($request->all());
    
        try {
            $comment->save();
            return back()->with(['message' => 'El comentario se ha creado exitosamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('comment.show', ['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        if (!$comment->isEditable()) {
            return back()->with(['message' => 'Han sobrepasado 10 minutos de edicion']);
        }
        return view('comment.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if(!($request->mail === $comment->mail)){
            return back()->withInput()->withErrors(['message' => 'El email no coindice con el comentario']);
        }

        if (!$comment->isEditable()) {
            return redirect('/post/' . $comment->post_id)->with(['message' => 'Han sobrepasado 15 minutos de edicion']);
        }
        
        $validated = $request->validate([
            'text' => 'required|string|min:10'
        ]);

        $comment->text = $validated['text'];

        try {
            $comment->save();
            return redirect('/post/' . $comment->post_id . '#' . $comment->id)->with(['message' => 'El comentario se ha creado exitosamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
