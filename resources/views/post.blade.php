@extends('layouts.blog-post')

@section('content')

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $post->title }}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{ $post->user->name }}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/900x300'}}" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">{{ $post->body }}</p>

                <hr>
                @if(Session::has('comment_message'))
                    {{session('comment_message')}}

                @endif

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(Auth::check())
                <div class="well">
                    <h4>Leave a Comment:</h4>

                 {!! Form::open(['method'=> 'POST', 'action'=>'PostCommentsController@store', 'files'=> true]) !!}
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="form-group">
                        {!! Form::label('body', 'Comment: ') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                </div>
                @endif

                <hr>

                <!-- Posted Comments -->
                @if(count($comments)>0)
                <!-- Comment -->
                @foreach($comments as $comment)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="{{ $comment->photo }}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        <p>{{$comment->body}}</p>
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                            {!! Form::open(['method'=> 'POST', 'action'=>'CommentRepliesController@postReply', 'files'=> true]) !!}
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="form-group">
                                {!! Form::label('body', 'Reply')!!}
                                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>2 ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary' ]) !!}
                            </div>
                            {!! Form::close() !!}

                        </div>
                        
                        <!-- End Nested Comment -->
                    </div>
                </div>

                @endforeach
                @endif
                
@stop
