{{-- resources/views/admin/users/create.blade.php --}}
<h1>Tambah Pengguna Baru</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div>Nama: <input type="text" name="name" value="{{ old('name') }}" required></div>
    <div>Email: <input type="email" name="email" value="{{ old('email') }}" required></div>
    <div>Password: <input type="password" name="password" required></div>
    <div>
        Peran:
        <select name="role" required>
            @foreach($roles as $role)
                <option value="{{ $role }}">{{ ucfirst($role) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        Prodi:
        <select name="prodi_id">
            <option value="">- Pilih Prodi -</option>
            @foreach($prodis as $prodi)
                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
            @endforeach
        </select>
    </div>
    <div>Tahun Masuk (jika mahasiswa): <input type="number" name="tahun_masuk" value="{{ old('tahun_masuk') }}"></div>
    <button type="submit">Simpan</button>
</form>