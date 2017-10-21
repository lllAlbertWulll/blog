@extends('layouts.blog_master')

@section('content')
    <!-- A wrapper for all the blog posts -->
    <div class="posts">
        <!-- A single blog post -->
        @foreach($blogs as $blog)
            <section class="post">
            <header class="post-header">
                <h2 class="post-title"><a href="blogs/detail/{{ $blog->id }}">{{ $blog->title }}</a></h2>
                <p class="post-meta">
                    @foreach($blog->categories as $category)
                        <a class="post-category" href="#">{{ $category->name }}</a>
                    @endforeach
                </p>
            </header>
        </section>
        @endforeach
    </div>
@endsection