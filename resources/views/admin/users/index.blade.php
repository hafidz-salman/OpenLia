<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Neumorphic Effect */
        .neumorphic {
            border-radius: 12px;
            background: #f0f0f0;
            box-shadow:  8px 8px 16px #d9d9d9,
                        -8px -8px 16px #ffffff;
            transition: all 0.3s ease;
        }
        
        /* Liquid Glass Effect */
        .liquid-glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 4px 20px 0 rgba(31, 38, 135, 0.15);
            color: white;
            transition: all 0.3s ease;
        }
        
        .liquid-glass:hover {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.25);
        }
        
        /* Table Styles */
        .table-header {
            background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%);
        }
        
        /* Custom Scrollbar */
        .table-container {
            overflow-x: auto;
        }
        
        .table-container::-webkit-scrollbar {
            height: 6px;
        }
        
        .table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .table-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        
        .table-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                Admin
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Manajemen Pengguna</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Pengguna</h1>
            </div>
            
            <div>
                <a href="{{ route('admin.users.create') }}" 
                   class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 md:py-3 md:px-6 rounded-full inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah User
                </a>
                <a href="{{ route('admin.dashboard') }}" 
                   class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 md:py-3 md:px-6 rounded-full inline-flex items-center">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
            </div>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                });
            </script>
        @endif

        <!-- Table Panel -->
        <div class="neumorphic p-6">
            @if($users->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-users-slash text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Belum ada data pengguna.</p>
                    <a href="{{ route('admin.users.create') }}" 
                       class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-full inline-block mt-4">
                        Tambah User Pertama
                    </a>
                </div>
            @else
                <div class="table-container">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider table-header">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider table-header">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider table-header">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider table-header">Prodi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider table-header">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 
                                           ($user->role === 'dosen' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->prodi->nama_prodi ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="liquid-glass bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full flex items-center justify-center"
                                           title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="liquid-glass bg-red-500 hover:bg-red-600 text-white p-2 rounded-full flex items-center justify-center"
                                                    title="Hapus">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination would go here if needed -->
            @endif
        </div>
    </div>

    <script>
        // Delete confirmation
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data pengguna akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
</body>
</html>