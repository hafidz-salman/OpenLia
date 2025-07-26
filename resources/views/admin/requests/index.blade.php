{{-- Menggunakan view minimalis --}}
<h1>Manajemen Permintaan Ruangan (Pending)</h1>
@if (session('success')) <p style="color:green;">{{ session('success') }}</p> @endif
<table border="1" style="width:100%">
    <thead>
        <tr>
            <th>Pemohon</th>
            <th>Ruangan</th>
            <th>Keperluan</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($requests as $request)
        <tr>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->room->nama_ruangan }}</td>
            <td>{{ $request->keperluan }}</td>
            <td>{{ \Carbon\Carbon::parse($request->waktu_mulai)->format('d M Y, H:i') }}</td>
            <td>{{ \Carbon\Carbon::parse($request->waktu_selesai)->format('d M Y, H:i') }}</td>
            <td>
                <form action="{{ route('admin.requests.approve', $request) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="color:green;">Approve</button>
                </form>
                <form action="{{ route('admin.requests.reject', $request) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="color:red;">Reject</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center;">Tidak ada permintaan yang pending.</td>
        </tr>
        @endforelse
    </tbody>
</table>