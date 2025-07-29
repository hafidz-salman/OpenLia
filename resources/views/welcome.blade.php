<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di OpenLia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'neumorphic': '8px 8px 15px #d1d9e6, -8px -8px 15px #ffffff',
                        'neumorphic-inset': 'inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #ffffff'
                    }
                },
            },
        }
    </script>
    <style>
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .role-card:hover {
            background-color: rgba(255, 255, 255, 0.7);
        }
    </style>
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
        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-8">
            
            <!-- Header with Login/Register -->
            <header class="absolute top-0 right-0 p-6 w-full">
                @if (Route::has('login'))
                    <nav class="flex flex-1 justify-end items-center bg-white/30 backdrop-blur-sm p-2 rounded-xl shadow-sm">
                        @auth
                            @php
                                $dashboardRoute = auth()->user()->role . '.dashboard';
                            @endphp
                            <a
                                href="{{ route($dashboardRoute) }}"
                                class="rounded-md px-4 py-2 text-gray-800 font-semibold transition hover:bg-white/50"
                            >
                                Dashboard
                            </a>
                        @else
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
            <section class="min-h-screen flex flex-col items-center justify-center text-center" data-aos="fade-in">
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
                    <a href="{{ route('login') }}" class="inline-block rounded-lg bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow-lg hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 transition-transform hover:scale-105">
                        Masuk Aplikasi
                    </a>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-20 px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl font-extrabold text-gray-800 sm:text-4xl">
                        Fitur Unggulan
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Solusi lengkap untuk manajemen ruangan kampus yang modern dan efisien
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <!-- Feature 1 -->
                    <div class="feature-card bg-white rounded-xl p-8 shadow-neumorphic transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-6 mx-auto">
                            <i class="fas fa-qrcode text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Akses Cepat via QR</h3>
                        <p class="text-gray-600">
                            Pindai QR Code di setiap ruangan untuk meminta akses secara instan. Tidak perlu kunci, tidak perlu repot.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card bg-white rounded-xl p-8 shadow-neumorphic transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-100 text-green-600 mb-6 mx-auto">
                            <i class="fas fa-calendar-alt text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Jadwal Selalu Sinkron</h3>
                        <p class="text-gray-600">
                            Lihat jadwal kuliah atau jadwal mengajar Anda yang selalu ter-update secara real-time, di mana pun dan kapan pun.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card bg-white rounded-xl p-8 shadow-neumorphic transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-purple-100 text-purple-600 mb-6 mx-auto">
                            <i class="fas fa-users-cog text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Dirancang untuk Semua</h3>
                        <p class="text-gray-600">
                            Sistem yang terintegrasi untuk Admin, Dosen, Mahasiswa, dan Petugas Kebersihan, memastikan semua alur kerja berjalan lancar.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Roles Section -->
            <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white/30 backdrop-blur-sm rounded-3xl mb-20">
                <div class="max-w-4xl mx-auto text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl font-extrabold text-gray-800 sm:text-4xl">
                        Manfaat untuk Setiap Peran
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Setiap pengguna mendapatkan pengalaman yang disesuaikan dengan kebutuhan mereka
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                    <!-- Role 1 -->
                    <div class="role-card bg-white/70 rounded-xl p-6 shadow-md transition-all duration-300 hover:bg-white/90" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-100 text-gray-800 mb-4 mx-auto">
                            <i class="fas fa-cog text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Admin <span class="text-gray-500">⚙️</span></h3>
                        <h4 class="text-md font-medium text-blue-600 mb-2">Kontrol Penuh</h4>
                        <p class="text-gray-600 text-sm">
                            Kelola semua data, setujui permintaan, dan lihat statistik penggunaan dari satu dashboard yang kuat.
                        </p>
                    </div>

                    <!-- Role 2 -->
                    <div class="role-card bg-white/70 rounded-xl p-6 shadow-md transition-all duration-300 hover:bg-white/90" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-4 mx-auto">
                            <i class="fas fa-chalkboard-teacher text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Dosen <span class="text-gray-500">🧑‍🏫</span></h3>
                        <h4 class="text-md font-medium text-blue-600 mb-2">Jadwal Fleksibel</h4>
                        <p class="text-gray-600 text-sm">
                            Kelola jadwal mengajar, ajukan perubahan, dan pinjam ruangan untuk kelas pengganti dengan mudah.
                        </p>
                    </div>

                    <!-- Role 3 -->
                    <div class="role-card bg-white/70 rounded-xl p-6 shadow-md transition-all duration-300 hover:bg-white/90" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-100 text-green-600 mb-4 mx-auto">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Mahasiswa <span class="text-gray-500">🎓</span></h3>
                        <h4 class="text-md font-medium text-blue-600 mb-2">Akses Mudah</h4>
                        <p class="text-gray-600 text-sm">
                            Lihat jadwal kuliah otomatis dan akses ruangan hanya dengan memindai QR Code.
                        </p>
                    </div>

                    <!-- Role 4 -->
                    <div class="role-card bg-white/70 rounded-xl p-6 shadow-md transition-all duration-300 hover:bg-white/90" data-aos="fade-up" data-aos-delay="400">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-yellow-100 text-yellow-600 mb-4 mx-auto">
                            <i class="fas fa-broom text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Petugas <span class="text-gray-500">🧹</span></h3>
                        <h4 class="text-md font-medium text-blue-600 mb-2">Misi Efisien</h4>
                        <p class="text-gray-600 text-sm">
                            Lihat tugas harian dengan jelas dan catat aktivitas pembersihan dalam sistem yang tergamifikasi.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="py-16 text-center text-sm text-black/70">
                OpenLia
            </footer>
        </div>
    </div>

    <script>
        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>
</body>
</html>