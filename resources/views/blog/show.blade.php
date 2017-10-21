@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $blog->title }}
                        <div>
                            @foreach($blog->categories as $category)
                                <a href="/" class="post-category">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel-body">
                        {!! $blog->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection