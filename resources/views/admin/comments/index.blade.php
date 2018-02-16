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
                <th>Comment's submitted</th>
                <th>Post</th>
                <th colspan="2" class="text-center">Action</th>
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
                <td><a href="{{ route('admin.comment.replies.show',$comment->id ) }}">View Reply</a></td>
                <td>
                    @if($comment->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id ]]) !!}

                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Un-Approve', ['class'=>'btn btn-success']) !!}
                            </div>

                        {!! Form::close() !!}
                    
                    @else
                         {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id ]]) !!}

                                <input type="hidden" name="is_active" value="1">
                                <div class="form-group">
                                    {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                                </div>

                        {!! Form::close() !!}
                    
                    @endif
                </td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id ]]) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>

                    {!! Form::close() !!}
                </td>
              </tr>
              @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Comments yet</h1>
    @endif

@stop
