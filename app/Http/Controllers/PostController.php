<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\Http\Requests\StorePost;

class PostController extends Controller
{
  public function index()
  {
      return view('posts.index', ['posts' => BlogPost::all()]);
  }

  public function show($id)
  {
    //reflash will store any flash variables for another session. do not put in a loop, quick way to an infinite loop
    // $request->session()->reflash();
    return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
  }

  public function create() 
  {
    return view('posts.create');
  }

  public function store(StorePost $request) 
  {
    $validatedData = $request->validated();
    $blogPost = BlogPost::create($validatedData);
    $request->session()->flash('status', 'Post was created');

    return redirect()->route('posts.show', ['post' => $blogPost->id]);
  }
  
  public function edit($id)
  {
    $post = BlogPost::findOrFail($id);
    return view('posts.edit', ['post' => $post]);
  }
  
  public function update(StorePost $request, $id)
  {
    $validatedData = $request->validated(); 
    $post = BlogPost::findOrFail($id);
    $post->fill($validatedData);
    $post->save();

    $request->session()->flash('status', 'Post was updated');
    
    return redirect()->route('posts.show', ['post' => $post->id]);
  }
  
  public function destroy(Request $request, $id)
  {
    $post = BlogPost::findOrFail($id);
    $post->delete();
    // BlogPost::destroy($id);
    $request->session()->flash('status', 'Post deleted');
    
    return redirect()->route('posts.index');
  }
}