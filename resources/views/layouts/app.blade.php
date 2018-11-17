<!DOCTYPE html>
{{--获取config/app.php中的locale选项--}}
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{--便于前端js获取到csrf令牌--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--如果标题没有定制，即默认是larabbs作为前缀--}}
    <title>@yield('title', 'LaraBBS') - Laravel</title>

    <!-- Styles -->
    {{--使用当前请求协议http或s为资源文件生成一个url--}}
    {{--例如http://larabbs.com/css/app.css--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container">

        @yield('content')

    </div>

    @include('layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>