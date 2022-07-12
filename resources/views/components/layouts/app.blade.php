<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $headerTitle ?? 'Laravel' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="app">

            <div>

                @if(isset($title))
                    <div>
                        {{ $title ?? 'Laravel' }}
                    </div>
                @endif

                <div>
                    {{ $slot }}
                </div>

                @if(isset($footer))
                    <div>
                        {{ $footer }}
                    </div>
                @endif

            </div>

        </div>
    </body>
</html>