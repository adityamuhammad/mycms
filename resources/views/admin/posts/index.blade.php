@extends('layouts.admin');

@section('content');
    <h1>Admin Posts</h1>

 <table class="table table-hover table-responsive">
    <thead>
      <tr>
        <th>id</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
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
          <td>{{ $post->user->name }}</td>
          <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ $post->body }}</td>
          <td>{{ $post->created_at->diffForHumans() }}</td>
          <td>{{ $post->updated_at->diffForHumans() }}</td>
        </tr>
            @endforeach
        @endif
    </tbody>
  </table>


@stop
