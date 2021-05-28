<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="https://kit.fontawesome.com/8fb0963895.js" crossorigin="anonymous"></script>
        <title>{{ env('APP_NAME') }}</title>
    </head>
    <body>
        <div id="app" class="container">
            <home-layout></home-layout>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
