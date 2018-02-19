@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create Post</div>

                <div class="panel-body">


                    <div class="row">


                    <div class="col-sm-3">
                        <img class="img-responsive img-rounded" src="{{$post['photo_id'] ? $post->photo['file'] : 'http://placehold.it/400x400'}}" alt="">
                    </div>

                        <div class="col-sm-9">
                             {!! Form::model($post, ['method'=> 'PUT', 'action'=> ['AuthorPostsController@update', $post->id], 'files'=> true]) !!}

                                    <div class="form-group">
                                        {!! Form::label('title', 'Title: ') !!}
                                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('category_id', 'Category: ') !!}
                                        {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('photo_id', 'Photo : ') !!}
                                        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('body', 'Description: ') !!}
                                        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6']) !!}
                                    </div>

                                {!! Form::close() !!}
                                {!! Form::model($post, ['method'=>'DELETE', 'action' => ['AuthorPostsController@destroy', $post->id], 'files'=> true]) !!}
                                    <div class="form-group">
                                        {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
                                    </div>
                                {!! Form::close() !!}
                          </div>
                            
                        </div>
                                @include('includes.form_error')
                                @include('includes.tinyeditor')
                     </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@stop
