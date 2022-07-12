<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'Laravel' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="app">
            <div class="container">

                <div class="appHeader">
                    {{ $title ?? 'Laravel' }}
                </div>

                <div class="appBody">
                    {{ $slot }}
                </div>

                @if(isset($footer))
                    <div class="appFooter">
                        {{ $footer }}
                    </div>
                @endif

            </div>
        </div>
    </body>
</html>