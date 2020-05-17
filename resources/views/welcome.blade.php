<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Artikels - by Laravel and Vue</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            <app-navbar></app-navbar>
            <app-articles></app-articles>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
