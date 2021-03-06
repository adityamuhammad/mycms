@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{ url("author/home/post/create") }}">Create Post</a>
                    </div>
                    Your post
                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Author</th>
                              <th>Category</th>
                              <th>Title</th>
                              <th class="text-center" colspan="2">Body</th>
                              <th>Created at</th>
                              <th>Updated at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($posts)
                              @foreach($posts as $post)
                                <tr>
                                  <td><img height="50" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
                                  <td>{{ $post->user->name }}</td>
                                  <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                                  <td><a href="{{ route('author.edit.post',$post->id) }}">{{ $post->title }}</a></td>
                                  <td>{{ str_limit($post->body, 20) }}</td>
                                  <td><a href="{{ route('home.post', $post->slug) }}">Read more</a></td>
                                  <td>{{ $post->created_at->diffForHumans() }}</td>
                                  <td>{{ $post->updated_at->diffForHumans() }}</td>
                                </tr>
                              @endforeach
                           @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
