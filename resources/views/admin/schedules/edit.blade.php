<h1>Edit Jadwal</h1>
<form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
    @csrf
    @method('PUT')
    <div>Mata Kuliah: <input type="text" name="mata_kuliah" value="{{ $schedule->mata_kuliah }}" required></div>
    <div>Angkatan: <input type="number" name="angkatan" value="{{ $schedule->angkatan }}" required></div>
    <div>Hari: 
        <select name="hari" required>
            @foreach($haris as $hari) <option value="{{ $hari }}" {{ $schedule->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option> @endforeach
        </select>
    </div>
    <div>Jam Mulai: <input type="time" name="jam_mulai" value="{{ $schedule->jam_mulai }}" required></div>
    <div>Jam Selesai: <input type="time" name="jam_selesai" value="{{ $schedule->jam_selesai }}" required></div>
    <div>Dosen:
        <select name="user_id" required>
            @foreach($dosens as $dosen) <option value="{{ $dosen->id }}" {{ $schedule->user_id == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option> @endforeach
        </select>
    </div>
    <div>Ruangan:
        <select name="room_id" required>
            @foreach($rooms as $room) <option value="{{ $room->id }}" {{ $schedule->room_id == $room->id ? 'selected' : '' }}>{{ $room->nama_ruangan }}</option> @endforeach
        </select>
    </div>
    <div>Prodi:
        <select name="prodi_id" required>
            @foreach($prodis as $prodi) <option value="{{ $prodi->id }}" {{ $schedule->prodi_id == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option> @endforeach
        </select>
    </div>
    <button type="submit">Update</button>
</form>