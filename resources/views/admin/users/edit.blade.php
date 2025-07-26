{{-- resources/views/admin/users/edit.blade.php --}}
<h1>Edit Pengguna: {{ $user->name }}</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.update', $user) }}" method="POST">
    @csrf
    @method('PUT') {{-- Penting untuk proses update --}}
    
    <div>
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <small>(Kosongkan jika tidak ingin mengubah password)</small>
    </div>
    <div>
        <label for="role">Peran:</label>
        <select name="role" id="role" required>
            @foreach($roles as $role)
                <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="prodi_id">Prodi:</label>
        <select name="prodi_id" id="prodi_id">
            <option value="">- Pilih Prodi -</option>
            @foreach($prodis as $prodi)
                <option value="{{ $prodi->id }}" {{ $user->prodi_id == $prodi->id ? 'selected' : '' }}>
                    {{ $prodi->nama_prodi }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="tahun_masuk">Tahun Masuk (jika mahasiswa):</label>
        <input type="number" name="tahun_masuk" value="{{ $user->tahun_masuk }}">
    </div>
    
    <button type="submit">Update</button>
    <a href="{{ route('admin.users.index') }}">Batal</a>
</form>