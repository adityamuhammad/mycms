@extends('layouts.admin')

@section('content')

<h1>Users</h1>
 <table class="table table-hover table-responsive">
    <thead>
      <tr>
        <th>id</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Updated at</th>
      </tr>
    </thead>
    
    <tbody>
        @if($users)
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><img height="50" src="{{ $user->photo ? $user->photo['file'] : 'No Images' }}" alt=""><td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role ? $user->role['name'] : 'User has no role' }}</td>
                <td>{{ $user->is_active == 1 ? 'Active' : 'Not Active' }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
  </table>

@stop
