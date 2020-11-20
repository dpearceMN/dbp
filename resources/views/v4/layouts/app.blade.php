<!DOCTYPE html>
<html class="no-js" lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:site_name" content="{{ trans('app.site_name') }}" />
    @if(env('APP_DEBUG') == 'true')
    <link rel="shortcut icon" href="/favicon_test.ico" type="image/x-icon">
    <link rel="icon" href="/favicon_test.ico" type="image/x-icon">
    @else
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
</head>

<body>
    @include('v4.layouts.partials.nav')
    <main id="app">
        @yield('content')
    </main>
    @yield('footer')
</body>

</html>