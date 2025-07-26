<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Permintaan Saya</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .status { font-weight: bold; text-transform: capitalize; }
        .status-pending { color: orange; }
        .status-approved { color: green; }
        .status-rejected { color: red; }
    </style>
</head>
<body>
    <h1>Riwayat Permintaan Peminjaman Ruangan</h1>
    <a href="{{ route('mahasiswa.dashboard') }}">Kembali ke Dashboard</a>

    <hr style="margin: 20px 0;">

    <table>
        <thead>
            <tr>
                <th>Ruangan</th>
                <th>Keperluan</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roomRequests as $request)
                <tr>
                    <td>{{ $request->room->nama_ruangan }}</td>
                    <td>{{ $request->keperluan }}</td>
                    <td>{{ \Carbon\Carbon::parse($request->waktu_mulai)->format('d M Y, H:i') }} - {{ \Carbon\Carbon::parse($request->waktu_selesai)->format('H:i') }}</td>
                    <td class="status status-{{ $request->status }}">{{ $request->status }}</td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align: center;">Anda belum pernah mengajukan peminjaman ruangan.</td></tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
