<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
    <!--<![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{{ asset('css/blog-old-ie.css')}}">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="{{ asset('css/blog.css')}}">
    <!--<![endif]-->
    @yield('css')

</head>
<body>
<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            {{--<h1 class="brand-title"> GegeWv </h1>--}}
            <h2 class="brand-tagline"> Life without regret, we can only do our best to not to regret.</h2>
            <h3 class="brand-author"><a href="{{ route('login') }}">─────  I'm 『 Gragamel 』</a></h3>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <div class="wrap">
                <div class="pure-menu pure-menu-horizontal pure-menu-open">
                    <ul class="pure-menu-list">
                        <li><a href="/">Blog</a></li>
                        <li><a href="{{ route('resume') }}">Resume</a></li>
                    </ul>
                </div>
            </div>
            @yield('content')
            <div class="footer">
                <div class="copyright">
                    Copyright &copy; 2017 <span> 格格巫 </span> All rights reserved.
                    <a href="http://www.miitbeian.gov.cn/"> 粤 ICP 备 17106381 号 </a>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('js')
</body>
</html>
