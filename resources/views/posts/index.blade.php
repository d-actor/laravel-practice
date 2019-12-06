@extends('layout')

@section('content')
  @forelse ($posts as $post)
    <p>
      <h3>
        <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
      </h3>
      <h4> - {{ $post->content}}</h3>
    </p>
  @empty
    <p>No posts yet...</p>
  @endforelse
@endsection