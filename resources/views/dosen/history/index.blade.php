<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Permintaan Saya</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; margin-bottom: 40px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .status { font-weight: bold; text-transform: capitalize; }
        .status-pending { color: orange; }
        .status-approved { color: green; }
        .status-rejected { color: red; }
    </style>
</head>
<body>
    <h1>Riwayat Permintaan Saya</h1>
    <a href="{{ route('dosen.dashboard') }}">Kembali ke Dashboard</a>

    <hr style="margin: 20px 0;">

    <h2>Riwayat Peminjaman Ruangan</h2>
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

    <h2>Riwayat Perubahan Jadwal</h2>
    <table>
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>Jadwal Lama</th>
                <th>Usulan Jadwal Baru</th>
                <th>Alasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
             @forelse ($scheduleChangeRequests as $request)
                <tr>
                    <td>{{ $request->schedule->mata_kuliah }}</td>
                    <td>{{ $request->schedule->hari }}, {{ date('H:i', strtotime($request->schedule->jam_mulai)) }}</td>
                    <td>{{ $request->hari_baru }}, {{ date('H:i', strtotime($request->jam_mulai_baru)) }}</td>
                    <td>{{ $request->alasan }}</td>
                    <td class="status status-{{ $request->status }}">{{ $request->status }}</td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align: center;">Anda belum pernah mengajukan perubahan jadwal.</td></tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
