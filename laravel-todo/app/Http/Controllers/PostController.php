<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function create(){
        $posts = Post::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('post.create', compact('posts'));
    }

    public function store(Request $request){
        $validated=$request->validate([
            'body'=>'required|max:100',
        ]);

        $validated['user_id']=auth()->id();

        $post=Post::create($validated);
        return back();
    }

    public function update(Request $request,Post $post){
        $validated=$request->validate([
            'body'=>'required|max:100',
        ]);

        $validated['user_id']=auth()->id();

        $post->update($validated); 
        return back();
    }

    public function destroy(Post $post){
        $post->delete();
        return back();
    }
}
