<h1>Form Peminjaman Ruangan</h1>

<form action="{{ route('booking.store') }}" method="POST">
    @csrf
    <div>
        <label for="room_id">Pilih Ruangan:</label>
        <select name="room_id" id="room_id" required>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->nama_ruangan }} (Gedung {{ $room->gedung }})</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="keperluan">Keperluan:</label>
        <input type="text" name="keperluan" id="keperluan" required placeholder="Contoh: Kelas Pengganti Matkul X">
    </div>
    <div>
        <label for="waktu_mulai">Waktu Mulai:</label>
        <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" required>
    </div>
    <div>
        <label for="waktu_selesai">Waktu Selesai:</label>
        <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" required>
    </div>
    <button type="submit">Kirim Permintaan</button>
</form>