@extends('layouts.admin')

@section('content')
    

    <h1>Edit Categories</h1>
        <div class="col-sm-6">
        
            {!! Form::model($category ,['method'=> 'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Category: ') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>

            {!! Form::close() !!}

            {!! Form::model($category ,['method'=> 'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}

                <div class="form-group">
                    {!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>

            {!! Form::close() !!}


        </div>

        <div class="col-sm-6">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Created at</th>
                  </tr>
                </thead>
                <tbody>
                  @if($categories)
                      @foreach($categories as $category)
                          <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
                          </tr>
                      @endforeach
                  @endif
                </tbody>
              </table>
        </div>
    
@stop
