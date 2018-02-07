@extends('layouts.admin')

@section('content')

<h1>Users</h1>
 <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created at</th>
        <th>Updated at</th>
      </tr>
    </thead>
    
    <tbody>
        @if($users)
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
  </table>

@stop