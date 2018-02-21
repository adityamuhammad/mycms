@extends('layouts.blog-post')

@section('content')

        <!-- Blog Post -->

        <!-- Title -->
        <h1>{{ $post->title }}</h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">{{ $post->user->name }}</a>
        </p><small>{{$post->user->role->name}}</small>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/900x300' }}" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">{!! $post->body !!}</p>

        <hr>
        @include('includes._flash')

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
                        <img height="64" class="media-object" src="{{ $comment->photo ? $comment->photo : 'http://placehold.it/64x64' }}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        <p>{{$comment->body}}</p>
                        <div class="comment-reply-container">

                        <button class="toggle-reply btn btn-info pull-right">Reply</button>
                        
                        <div class="comment-reply">

                            {!! Form::open(['method'=> 'POST', 'action'=>'CommentRepliesController@postReply', 'files'=> true]) !!}

                                <div class="form-group">
                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                    {!! Form::label('body', 'Reply')!!}
                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>2 ]) !!}
                                </div>

                                    <div class="form-group">
                                        {!! Form::submit('Submit Reply', ['class'=>'btn btn-primary' ]) !!}
                                </div>

                            {!! Form::close() !!}
                            </div>

                        </div>
                        <!-- Nested Comment -->

                        @if(count($comment->replies) > 0)
                            @foreach($comment->replies as $reply)
                                @if($reply->is_active == 1)

                                <div class="nested-comments media">
                                    <a class="pull-left" href="#">
                                        <img height="64" class="media-object" src="{{$reply->photo ? $reply->photo : 'http://placehold.it/64x64'}}" alt="">
                                    </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->author}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h4>
                                    <p>{{$reply->body}}</p>
                                </div>
                    </div>
                                @endif
                            @endforeach
                        @endif


                <!-- End Nested Comment -->
            </div>
        </div>

        @endforeach
        @endif
            
@stop

@section('scripts')
    <script>
        $(".comment-reply-container .toggle-reply").click(function(){
            $(this).next().slideToggle("slow");
        });

    </script>

@stop
