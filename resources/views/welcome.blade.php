<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        @vite(['resources/uikit/css/uikit.css', 'resources/uikit/js/uikit.js', 'resources/uikit/js/uikit-icons.js'])

        <style>
            #app {
                min-width: 800px;
            }
        </style>
    </head>
<body class="antialiased">
<div id="app" class="uk-position-top-center">
        <app></app>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
