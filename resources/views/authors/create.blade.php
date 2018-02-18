@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create Post</div>

                <div class="panel-body">


                    <div class="row col-md-9 col-md-offset-1">
                     {!! Form::open(['method'=> 'POST', 'action'=>'AuthorPostsController@store', 'files'=> true]) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title: ') !!}
                            {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('category_id', 'Category: ') !!}
                            {!! Form::select('category_id', [''=> 'Choose Categories']+ $categories, null, ['class'=>'form-control']) !!}
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
                            {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
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
