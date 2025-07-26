<h1>Daftar Pengguna Prodi {{ Auth::user()->prodi->nama_prodi ?? '' }}</h1>
<a href="{{ route('dosen.dashboard') }}">Kembali ke Dashboard</a>
<hr>

<table border="1" style="width:100%">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Peran</th>
            <th>Tahun Masuk</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->tahun_masuk ?? 'N/A' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align:center;">Tidak ada pengguna lain di prodi Anda.</td>
            </tr>
        @endforelse
    </tbody>
</table>