@extends('layouts.blog-home')

@section('content')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                @if($posts)
                    @foreach($posts as $post)
                <h2>
                    <a href="{{ route('home.post', $post->slug) }}">{{$post->title}}</a>
                </h2>
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>
                <hr>
                <img class="img-responsive" src="{{ $post->photo ? $post->photo->file :'http://placehold.it/900x300'}}" alt="">
                <hr>
                <p>{!! str_limit($post->body, 60)!!}</p>
                <a class="btn btn-primary" href="{{ route('home.post', $post->slug) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                    @endforeach
                @endif


                <!-- Pager -->
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-5">
                        {{$posts->render()}}
                    </div>

                    <ul class="pager">
                        <li class="previous">
                            <a href="?page={{$posts->hasMorePages()}}">&larr; Newer</a>
                        </li>
                        <li class="next">
                            <a href="?page={{$posts->lastPage()}}">Older &rarr;</a>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                        {!! Form::open(['method'=>'GET','url'=>'post/']) !!}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                @if($categories)
                                    @foreach($categories as $category)
                                        <ul>
                                            <li><a href="#">{{$category->name}}</a></li>
                                        </ul>
                                    @endforeach
                                @endif
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->


@endsection
