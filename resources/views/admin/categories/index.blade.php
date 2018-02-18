@extends('layouts.admin')

@section('content')
    
    <h1>Categories</h1>
        <div class="col-sm-6">
        
            {!! Form::open(['method'=> 'POST', 'action'=>'AdminCategoriesController@store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Category: ') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
            @include('includes.form_error')

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
                            <td><a href="{{route('admin.categories.edit', $category->id)}}">{{ $category->name }}</a></td>
                            <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
                          </tr>
                      @endforeach
                  @endif
                </tbody>
              </table>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-5">
                        {{$categories->render()}}
                    </div>
                </div>

            </div>
    
@stop
