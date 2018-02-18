@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Create Post
                    Yourpost
                    <table>
                      <tr>
                          @if($posts)
                          @foreach($posts as $post)
                              <td>{{ $post->title }}</td>
                          @endforeach
                      @endif
                      </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
