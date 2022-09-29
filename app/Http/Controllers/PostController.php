<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts from Models
        $posts = Post::latest()->get();

        //return view with data
        return view('posts', compact('posts'));
    }

    public function store(Request $request) 
    {
        // make Validation
        $validator= Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        // check Validation
        if ($validator->fails()) {  
            return response()->json($validator->errors(), 422);
        }

        // create Post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        // return Respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan!',
            'data'    => $post 
        ]);
    }

    public function show(Post $post) 
    {
        // Return Response
        return response()->json
        ([
            'success' => true,
            'message' => 'Detail Data Post',
            'data' => $post
        ]);
    }

    public function update(Request $request, Post $post) 
    {
        // Make validator rules
        $validator= Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create Post
        $post->update([
            'title'     => $request->title, 
            'content'   => $request->content
        ]);

        // return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $post  
        ]);
    }
}
