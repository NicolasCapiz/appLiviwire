<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Livewire</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css"/ >

        @livewireStyles

    </head>
    <body>
        @
        @yield('content')

        @livewireScripts
        <script src="/jquery.js"></script>
        <script src="/build/jquery.datetimepicker.full.min.js"></script>
    </body>
</html>
