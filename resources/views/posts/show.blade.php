@extends('layout')

@section('content')
  <h1>{{ $post->title }}</h1>
  <p>{{ $post->content }}</p>

  <p>Created {{ $post->created_at->diffForHumans() }}
  
  @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
    <br />
    <strong>New!</strong>
  @endif
@endsection