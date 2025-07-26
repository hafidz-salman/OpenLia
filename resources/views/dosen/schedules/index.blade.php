<h1>Jadwal Mengajar Saya</h1>
<a href="{{ route('dosen.dashboard') }}">Kembali ke Dashboard</a>
<hr>

<table border="1" style="width:100%">
    <thead>
        <tr>
            <th>Hari & Jam</th>
            <th>Mata Kuliah</th>
            <th>Prodi & Angkatan</th>
            <th>Ruangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jadwalDosen as $jadwal)
            <tr>
                <td>{{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</td>
                <td>{{ $jadwal->mata_kuliah }}</td>
                <td>{{ $jadwal->prodi->nama_prodi }} ({{ $jadwal->angkatan }})</td>
                <td>{{ $jadwal->room->nama_ruangan }}</td>
                <td>
                    <a href="{{ route('dosen.jadwal.change.show', $jadwal) }}">Ajukan Perubahan</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;">Anda tidak memiliki jadwal mengajar.</td>
            </tr>
        @endforelse
    </tbody>
</table>