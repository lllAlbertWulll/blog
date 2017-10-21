@extends('layouts.blog_master')

@section('content')
    <div class="blog-detail">
        <div class="blog-title">
            <h1>{{ $blog->title }}</h1>
            <div>
                @foreach($blog->categories as $category)
                    <a href="/" class="post-category">{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="blog-content">
                {!! $blog->body !!}
            </div>
        </div>
    </div>
@endsection