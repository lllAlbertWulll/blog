@extends('layouts.blog_master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/prism.css')}}">
    <link rel="stylesheet" href="{{ asset('css/show.css')}}">
@endsection

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

@section('js')
    <script src="{{ asset('js/prism.js') }}"></script>
@endsection