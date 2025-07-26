<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di OpenLia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        }
    </script>
</head>
<body class="antialiased bg-gray-100">
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1554469384-e58fac1662d5?q=80&w=2070&auto=format&fit=crop" 
                 alt="Modern building interior" 
                 class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-100 to-transparent"></div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 w-full max-w-4xl mx-auto px-6 lg:px-8 text-center">
            
            <!-- Header with Login/Register -->
            <header class="absolute top-0 right-0 p-6 w-full">
                @if (Route::has('login'))
                    <nav class="flex flex-1 justify-end items-center bg-white/30 backdrop-blur-sm p-2 rounded-xl shadow-sm">
                        @auth
                            {{-- Jika pengguna sudah login, tampilkan tombol Dashboard --}}
                            @php
                                // Membuat nama rute dinamis berdasarkan peran pengguna (contoh: 'admin.dashboard')
                                $dashboardRoute = auth()->user()->role . '.dashboard';
                            @endphp
                            <a
                                href="{{ route($dashboardRoute) }}"
                                class="rounded-md px-4 py-2 text-gray-800 font-semibold transition hover:bg-white/50"
                            >
                                Dashboard
                            </a>
                        @else
                            {{-- Jika pengguna belum login, tampilkan tombol Login dan Register --}}
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-4 py-2 text-gray-800 font-semibold transition hover:bg-white/50"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-4 py-2 text-gray-800 font-semibold transition hover:bg-white/50"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <!-- Hero Section -->
            <main class="mt-24 sm:mt-0">
                <div class="flex items-center justify-center space-x-4">
                    <svg class="h-16 w-auto text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.311a7.5 7.5 0 0 1-7.5 0c-1.42 0-2.798-.38-4.03-1.034a1.5 1.5 0 0 1-.82-1.342V6.332c0-.827.534-1.555 1.32-1.865a11.95 11.95 0 0 1 7.36-2.25c2.75 0 5.355.672 7.36 1.854a1.5 1.5 0 0 1 1.32 1.866v10.425a1.5 1.5 0 0 1-.82 1.342a11.95 11.95 0 0 1-4.03 1.034Z" />
                    </svg>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800">
                        OpenLia
                    </h1>
                </div>

                <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
                    Sistem Manajemen Ruangan Cerdas. Akses cepat via QR, penjadwalan terpusat, dan pengelolaan efisien untuk semua kebutuhan kampus Anda.
                </p>

                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('login') }}" class="inline-block rounded-lg bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow-lg hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                        Masuk Aplikasi
                    </a>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-16 text-center text-sm text-black/70 mt-12">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </div>
</body>
</html>
