<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskFlow</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .animate-rotate {
            animation: rotate 60s linear infinite;
        }
        .animate-pulse-fade {
            animation: pulse-fade 8s ease-in-out infinite alternate;
        }
    </style>
</head>

<body class="antialiased font-sans text-gray-800">
    <div class="relative min-h-screen bg-gray-50 flex items-center justify-center overflow-hidden py-10">
        
        <div class="absolute inset-0 z-0 opacity-40">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-300 rounded-lg transform -rotate-45" style="animation: rotate 60s linear infinite;"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-purple-300 rounded-full" style="animation: pulse-fade 8s ease-in-out infinite alternate;"></div>
            <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-green-300 rounded-3xl transform translate-x-1/2 -translate-y-1/2 rotate-12 opacity-30" style="animation: pulse-fade 8s ease-in-out infinite alternate; animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                
                <div class="relative hidden md:flex items-center justify-center">
                    <img src="{{ asset('images/TASKFLOW-LOGO.png') }}" alt="Students studying" class="w-full h-auto">
                </div>

                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                        Platform Manajemen Tugas #1 untuk Mahasiswa.
                    </h1>
                    
                    <p class="mt-4 text-lg text-gray-600">
                        TaskFlow membantumu mengorganisir tugas, melacak deadline, dan tetap fokus pada yang terpenting agar kamu bisa jadi mahasiswa berprestasi.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row md:justify-start justify-center gap-4">
                        <a href="{{ route('register') }}" class="inline-block rounded-md bg-gray-800 px-8 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-gray-700">
                            Mulai Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="inline-block rounded-md px-8 py-3 text-sm font-semibold text-gray-800 ring-1 ring-inset ring-gray-300 shadow-sm transition hover:bg-gray-100">
                            Sudah Punya Akun?
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>