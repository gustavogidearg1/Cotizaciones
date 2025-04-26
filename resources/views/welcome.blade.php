<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>{{ config('app.name', 'Comofra') }}: Comofra</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            @else
            <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
            @endif
    </head>
    <body class="font-sans antialiased">

                <!-- Incluir el menú -->
                @include('layouts.menu')


                <!-- Contenido de la página -->
                <div class="min-h-screen bg-gray-100">
                    <div class="container mx-auto px-6 py-8">
                        <h1 class="text-3xl font-bold text-gray-900">Bienvenido al sistema de Comofra SRL</h1>
                        <p class="mt-4 text-gray-600">
                            Si ya tienes un usuario y contraseña, por favor
                            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">accede aquí</a>.
                            Si no tienes acceso, solicítalo a
                            <a href="mailto:industrial@comofrasrl.com.ar" class="text-blue-600 hover:underline">industrial@comofrasrl.com.ar</a>.
                            ¡Gracias!
                        </p>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
