@extends('layouts.admin');

@section('content');
    <h1>Admin Posts</h1>

    @if(session()->has('deleted_post'))
        <p class="alert alert-danger">{{session('deleted_post')}}</p>
    @endif
 <table class="table table-hover table-responsive">
    <thead>
      <tr>
        <th>id</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>
        <th>Title</th>
        <th colspan="2" class="text-center">Body</th>
        <th>Created at</th>
        <th>Updated at</th>
      </tr>
    </thead>
    
    <tbody>
        @if($posts)
            @foreach($posts as $post)
        <tr>
          <td>{{ $post->id }}</td>
          <td><img height="50" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
          <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->user->name }}</a></td>
          <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ str_limit($post->body, 20) }}</td>
          <td><a href="{{ route('home.post', $post->id) }}">Read more</a></td>
          <td><a href="{{ route('admin.comments.show', $post->id) }}">View Comments</a></td>
          <td>{{ $post->created_at->diffForHumans() }}</td>
          <td>{{ $post->updated_at->diffForHumans() }}</td>
        </tr>
            @endforeach
        @endif
    </tbody>
  </table>


@stop
