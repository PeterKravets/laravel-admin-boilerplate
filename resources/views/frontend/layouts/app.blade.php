<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', app_name())</title>

    <meta name="description" content="@yield('meta_description', 'Bolierplate')">
    @yield('meta')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    <link rel="stylesheet" href="{{ mix('css/frontend.css') }}">

</head>
<body>

<div id="app">
    @yield('body')
</div><!-- #app -->

<!-- Scripts -->

@stack('before-scripts')
<script src="{{ mix('js/frontend.js') }}"></script>
@stack('after-scripts')

@include('includes.scripts')
</body>
</html>
