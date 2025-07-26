<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Jadwal</title>
    <style>table, th, td { border: 1px solid black; border-collapse: collapse; padding: 5px; }</style>
</head>
<body>
    <h1>Manajemen Jadwal</h1>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a> | 
    <a href="{{ route('admin.schedules.create') }}">Tambah Jadwal</a> | 
    <a href="{{ route('admin.schedules.import.show') }}">Impor dari Excel</a>
    <hr>
    @if (session('success')) <p style="color:green;">{{ session('success') }}</p> @endif
    <table>
        <thead>
            <tr>
                <th>Hari & Jam</th><th>Mata Kuliah</th><th>Prodi & Angkatan</th>
                <th>Dosen</th><th>Ruangan</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $schedule)
            <tr>
                <td>{{ $schedule->hari }}, {{ date('H:i', strtotime($schedule->jam_mulai)) }} - {{ date('H:i', strtotime($schedule->jam_selesai)) }}</td>
                <td>{{ $schedule->mata_kuliah }}</td>
                <td>{{ $schedule->prodi->nama_prodi ?? 'N/A' }} ({{ $schedule->angkatan }})</td>
                <td>{{ $schedule->user->name ?? 'N/A' }}</td>
                <td>{{ $schedule->room->nama_ruangan ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('admin.schedules.edit', $schedule) }}">Edit</a>
                    <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Yakin?')">
                        @csrf @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>