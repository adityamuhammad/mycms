@extends('layouts.admin')

@section('content')

    <h1>Media</h1>


   @if($photos)

   <table class="table">
   <thead>
     <tr>
       <th>id</th>
       <th>Name</th>
       <th>Created at</th>
     </tr>
   </thead>
   <tbody>
       @foreach($photos as $photo)
     <tr>
       <td>{{ $photo->id }}</td>
       <td><img height="50" src="{{ $photo->file }}" alt=""></td>
       <td>{{ $photo->created_at ? $photo->created_at->diffForHumans() : 'no date' }}</td>
       <td>
       {!! Form::model($photo, ['method'=>'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id], 'files'=> true]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>
            {!! Form::close() !!}
       </td>
     </tr>
       @endforeach
   </tbody>
   </table>

   @endif

@stop
