@extends('layouts.admin')


@section('content')
    <div class="row">
        
    <div class="col-sm-3">
        <img class="img-responsive img-rounded" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="">
    </div>

    <div class="col-sm-9">
            <h2>Edit Users</h2>
                {!! Form::model($user, ['method'=> 'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=> true]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name : ') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email : ') !!}
                    {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'example@gmail.com']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('role_id', 'Role : ') !!}
                    {!! Form::select('role_id', [''=>'Choose role'] + $roles, null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('is_active', 'Status : ') !!}
                    {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class'=>'form-control']) !!}
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
                    {!! Form::submit('Edit', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>

            {!! Form::close() !!}
        
            {!! Form::model($user, ['method'=> 'DELETE', 'action'=>['AdminUsersController@destroy', $user->id], 'files'=> true]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>

            {!! Form::close() !!}
    </div>
</div>
    @include('includes.form_error')
    
@stop
