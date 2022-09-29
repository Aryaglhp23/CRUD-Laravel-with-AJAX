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
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post 
        ]);
    }
}
