<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BlogPost;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::all()]);
    }

    public function show(Request $request, $id)
    {
      //reflash will store any flash variables for another session. do not put in a loop, quick way to an infinite loop
      $request->session()->reflash();
      return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    public function create() 
    {
      return view('posts.create');
    }

    public function store(Request $request) 
    {
      $blogPost = new BlogPost();
      $blogPost->title = $request->input('title');
      $blogPost->content = $request->input('content');
      $blogPost->save();

      $request->session()->flash('status', 'Post was created');

      return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }
}
