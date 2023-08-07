<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script> const global = globalThis; </script>
        <meta name="csrf-token" content="{{csrf_token()}}" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
        crossorigin="anonymous" />
        <title>File Manager</title>

        @viteReactRefresh
        @vite('resources/js/app.jsx')
    </head>
    <body>
        <div id="app"></div>
    </body>
</html>