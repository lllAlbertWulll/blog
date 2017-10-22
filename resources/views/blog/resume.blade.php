@extends('layouts.blog_master')

@section('css')
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/resume.css')}}">
@endsection

@section('content')
    <div class="resume">
        <img class="avatar" src="{{ asset('image/avatar.jpg') }}" />
        <div id="name">Gargamel</div>
        <div id="situation">在校生，就读于广东岭南职业技术学院</div>
        <div class="skills">
            <a class="skill-php" href="#">PHP programmer</a>
        </div>
        <div class="links">
            <a class="fa fa-github fa-2x" href="https://github.com/lllAlbertWulll/"></a>
            <a class="fa fa-weibo fa-2x" href="https://weibo.com/u/5848386571"></a>
        </div>
    </div>
@endsection