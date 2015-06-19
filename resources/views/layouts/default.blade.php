<?php $minified = (App::environment() !== 'local') ? '.min' : ''; ?>
<!doctype html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ trans('rdv.title') }}</title>
    <link rel="stylesheet" type="text/css" href="/assets/vendor/semantic-ui/dist/semantic{{ $minified }}.css">
</head>
<body>
    @yield('main')
    <script src="/assets/vendor/jquery/dist/jquery{{ $minified }}.js"></script>
    <script src="/assets/vendor/semantic-ui/dist/semantic{{ $minified }}.js"></script>
    <script src="/assets/vendor/pusher/dist/pusher{{ $minified }}.js"></script>
    <script src="/assets/src/js/app.js"></script>
    <script src="/assets/src/js/app.pusher.js"></script>
    <script src="/assets/src/js/app.calendar.js"></script>
    <script src="/assets/src/js/run.js"></script>
    @yield('scripts')
</body>
</html>
