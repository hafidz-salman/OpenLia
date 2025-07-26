<h1>Tambah Jadwal Baru</h1>
<form action="{{ route('admin.schedules.store') }}" method="POST">
    @csrf
    <div>Mata Kuliah: <input type="text" name="mata_kuliah" required></div>
    <div>Angkatan: <input type="number" name="angkatan" placeholder="Contoh: 2022" required></div>
    <div>Hari: 
        <select name="hari" required>
            @foreach($haris as $hari) <option value="{{ $hari }}">{{ $hari }}</option> @endforeach
        </select>
    </div>
    <div>Jam Mulai: <input type="time" name="jam_mulai" required></div>
    <div>Jam Selesai: <input type="time" name="jam_selesai" required></div>
    <div>Dosen:
        <select name="user_id" required>
            @foreach($dosens as $dosen) <option value="{{ $dosen->id }}">{{ $dosen->name }}</option> @endforeach
        </select>
    </div>
    <div>Ruangan:
        <select name="room_id" required>
            @foreach($rooms as $room) <option value="{{ $room->id }}">{{ $room->nama_ruangan }}</option> @endforeach
        </select>
    </div>
    <div>Prodi:
        <select name="prodi_id" required>
            @foreach($prodis as $prodi) <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option> @endforeach
        </select>
    </div>
    <button type="submit">Simpan</button>
</form>