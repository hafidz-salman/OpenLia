<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - OpenLia</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100">
    <div class="relative min-h-screen flex items-center justify-center py-12">
        <!-- Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1554469384-e58fac1662d5?q=80&w=2070&auto=format&fit=crop" 
                 alt="Modern building interior" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-100 to-transparent"></div>
        </div>

        <!-- Register Card -->
        <div class="relative z-10 w-full max-w-md p-8 space-y-6 bg-white/50 backdrop-blur-xl rounded-2xl shadow-lg">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h1>
                <p class="mt-2 text-gray-600">Daftar sebagai Mahasiswa</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                </div>
                
                <!-- Prodi -->
                <div>
                    <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <select id="prodi_id" name="prodi_id" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Pilih Program Studi --</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tahun Masuk -->
                <div>
                    <label for="tahun_masuk" class="block text-sm font-medium text-gray-700">Tahun Masuk</label>
                    <input id="tahun_masuk" type="number" name="tahun_masuk" value="{{ old('tahun_masuk') }}" required placeholder="Contoh: 2023"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                </div>


                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Register
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>
</body>
</html>
