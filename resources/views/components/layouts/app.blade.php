<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $headerTitle ?? 'Laravel' }}</title>

        <livewire:styles />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        
        <!-- Start App Container -->
        <div class="app">
        
            <!-- Start Navbar -->
            <x-navbar.nav></x-navbar.nav>
            <!-- /End Navbar -->

            <!-- Start Body Content -->
            <div class="pt-16 bg-gray-100 flex flex-col h-screen">

                <!-- Header -->
                <header class="py-5 px-10">
                    <h2 class="text-2xl">{{ $title ?? 'Laravel' }}</h2>
                </header>

                <!-- Slot Content -->
                <div class="py-5 px-10 bg-gray-200 flex-grow">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <footer class="py-5 px-10">
                    Footer
                </footer>

            </div>
            <!-- End Body Content -->

        </div>

        
        <livewire:scripts />
    </body>
</html>