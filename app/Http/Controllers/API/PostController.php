<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function index()
    {
        return response()->json(['posts' => Post::all()], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:255'
        ]);

        $post = Post::create($request->all());
        return response()->json($post, 201);
    }


    public function show(Post $post)
    {
        return response()->json($post, 200);
    }


    public function update(Request $request,Post $post)
    {

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:255'
        ]);

        $post->update($request->all());
        return response()->json($post, 200);
    }


    public function destroy(Post $post)
    {
        $post->delete();
        $posts = Post::all();
        return response()->json($posts, 204);
    }

}
