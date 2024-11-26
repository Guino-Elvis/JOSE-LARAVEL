<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased" x-data="{ sidebarVisible: false }">

        <x-banner />
    
        <div class="min-h-screen bg-white">
    
            @if ( Auth::user() && request()->routeIs(
                    'scrapy',
                    'scrapy.pag',
                  ))
                <x-sidebar>
                    <x-slot name="content">
                        <!-- Page Content -->
                        <div>
                            {{ $slot }}
                        </div>
                    </x-slot>
                </x-sidebar>
            @else
                @livewire('navigation-menu')
                <main>
                    {{ $slot }}
                </main>
            @endif
    
        </div>
    
        @stack('modals')
    
        @livewireScripts
    
        @stack('js')
    
        <script type="text/javascript">
            Livewire.on('alert', function(message) {
                Swal.fire(
                    'Mensaje del sistema',
                    message,
                    'success'
                )
            });
            AOS.init();
        </script>
    </body>
</html>
