@extends('layouts.admin')

@section('content')
    @if(count($comments) > 0)

        <h1>Comment</h1>

        <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Body</th>
                <th>Comment's author</th>
                <th>Comment's body</th>
                <th>Comment's body</th>
                <th>Post</th>
              </tr>
            </thead>
            <tbody>
              @foreach($comments as $comment)
              <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->body}}</td>
                <td>{{$comment->author}}</td>
                <td>{{$comment->email}}</td>
                <td>{{$comment->created_at->diffForHumans()}}</td>
                <td><a href="{{ route('home.post',$comment->post->id ) }}">View Post</a></td>
              </tr>
              @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Comments yet</h1>
    @endif

@stop
