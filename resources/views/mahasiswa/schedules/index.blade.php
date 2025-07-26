<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Kuliah</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Jadwal Kuliah Anda</h1>
    <a href="{{ route('mahasiswa.dashboard') }}">Kembali ke Dashboard</a>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Hari & Jam</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwalKuliah as $jadwal)
                <tr>
                    <td>{{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</td>
                    <td>{{ $jadwal->mata_kuliah }}</td>
                    <td>{{ $jadwal->user->name }}</td>
                    <td>{{ $jadwal->room->nama_ruangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada jadwal kuliah untuk prodi dan angkatan Anda saat ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
