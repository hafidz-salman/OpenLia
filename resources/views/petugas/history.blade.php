<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pembersihan</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Riwayat Pembersihan Saya</h1>
    <a href="{{ route('petugas.dashboard') }}">Kembali ke Dashboard</a>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Ruangan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Durasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
            <tr>
                <td>{{ $log->room->nama_ruangan }}</td>
                <td>{{ \Carbon\Carbon::parse($log->start_time)->format('d M Y, H:i') }}</td>
                <td>{{ $log->end_time ? \Carbon\Carbon::parse($log->end_time)->format('H:i') : 'Masih Berlangsung' }}</td>
                <td>
                    @if ($log->end_time)
                        {{ \Carbon\Carbon::parse($log->start_time)->diffForHumans($log->end_time, true) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">Anda belum memiliki riwayat pembersihan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Link untuk navigasi halaman --}}
    <div style="margin-top: 20px;">
        {{ $logs->links() }}
    </div>
</body>
</html>
