<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Twogether Music Space') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="relative min-h-screen w-full overflow-hidden">

        <!-- background: setengah hitam, setengah foto blur -->
        <div class="absolute inset-y-0 left-0 w-1/2 bg-black"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('images/studio.jpg') }}'); filter: blur(6px); transform: scale(1.1);">
        </div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-black/30"></div>

        <!-- konten (logo + card form) -->
        <div class="relative z-10 flex min-h-screen flex-col items-center justify-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl overflow-hidden sm:rounded-3xl">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>