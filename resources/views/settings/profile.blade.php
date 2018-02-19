@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profile</div>

                <div class="panel-body">
                    
                <div class="col-sm-3">
                    <img class="img-responsive img-rounded" src="{{Auth::user()->photo ? Auth::user()->photo->file : 'http://placehold.it/400x400'}}" alt="">
                </div>

                <div class="col-sm-9">
                            {!! Form::model(Auth::user(), ['method'=> 'PUT', 'action'=>['SettingsController@updateProfile',Auth::user()->id ], 'files'=> true]) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Name : ') !!}
                                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Email : ') !!}
                                {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'example@gmail.com']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('photo_id', 'Photo : ') !!}
                                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Password : ') !!}
                                {!! Form::password('password', ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
                            </div>

                        {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('includes.form_error')
@stop
