<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Tugas Mahasiswa</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom CSS for subtle animations */
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes pulse-fade {
            0% { opacity: 0.2; transform: scale(0.9); }
            50% { opacity: 0.4; transform: scale(1.1); }
            100% { opacity: 0.2; transform: scale(0.9); }
        }
        .animate-rotate {
            animation: rotate 60s linear infinite; /* slow continuous rotation */
        }
        .animate-pulse-fade {
            animation: pulse-fade 8s ease-in-out infinite alternate;
        }
    </style>
</head>

<body class="antialiased">
    <div class="relative min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-gray-50 to-gray-200 text-gray-800 overflow-hidden">
        
        <div class="absolute inset-0 z-0 opacity-40">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-300 rounded-lg transform -rotate-45 animate-rotate"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-purple-300 rounded-full animate-pulse-fade"></div>
            <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-green-300 rounded-3xl transform translate-x-1/2 -translate-y-1/2 rotate-12 opacity-30 animate-pulse-fade" style="animation-delay: 2s;"></div>
        </div>


        <div class="relative z-10 text-center p-6 max-w-lg bg-white bg-opacity-90 backdrop-blur-sm rounded-lg shadow-xl border border-gray-100">
            
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                TaskFlow
            </h1>
            
            <p class="mt-4 text-lg text-gray-600">
                Ubah kekacauan menjadi keteraturan. Fokus pada apa yang terpenting dalam perkuliahan Anda.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row sm:justify-center gap-4">
                <a href="{{ route('login') }}" 
                   class="inline-block rounded-md bg-gray-800 px-8 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-gray-700 hover:shadow-lg">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                   class="inline-block rounded-md px-8 py-3 text-sm font-semibold text-gray-800 ring-1 ring-inset ring-gray-300 shadow-sm transition hover:bg-gray-100 hover:shadow-md">
                    Daftar Akun Baru
                </a>
            </div>
        </div>
        
        <footer class="absolute bottom-5 text-gray-500 text-sm z-10">
            Dibuat oleh Kelompok 3
        </footer>
    </div>
</body>

</html>