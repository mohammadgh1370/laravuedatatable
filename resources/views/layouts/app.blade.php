<!DOCTYPE html>
<html lang="{{App::getLocale()}}" dir="{{App::isLocale('en') ? 'ltr' : 'rtl' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="guard" content="{{ \Auth::getDefaultDriver() != 'web' ?\Auth::getDefaultDriver() : 'user' }}">
    <title>@yield('page-title')</title>

    <link rel="stylesheet" href="{{asset('panel/app/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('panel/app/css/panel.css')}}">
    @yield('css')
</head>
<body class="hold-transition @yield('class') sans">

<div id="{{\Auth::getDefaultDriver() != 'web' ?\Auth::getDefaultDriver() : 'user'}}">

    @include('admin.partials.flash')

    @yield('main')

</div>
<script src="{{asset('panel/app/js/app.js')}}"></script>
<script src="{{asset('panel/app/js/panel.js')}}" defer></script>
@yield('js')
</body>
</html>
