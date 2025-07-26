<h1>Ajukan Perubahan Jadwal</h1>
<p><strong>Mata Kuliah:</strong> {{ $schedule->mata_kuliah }}</p>
<p><strong>Jadwal Lama:</strong> {{ $schedule->hari }}, {{ date('H:i', strtotime($schedule->jam_mulai)) }} - {{ date('H:i', strtotime($schedule->jam_selesai)) }}</p>
<hr>

<form action="{{ route('dosen.jadwal.change.store', $schedule) }}" method="POST">
    @csrf
    <div>Alasan Perubahan: <textarea name="alasan" required></textarea></div>
    <div>
        Hari Baru:
        <select name="hari_baru" required>
            @foreach($haris as $hari)
                <option value="{{ $hari }}">{{ $hari }}</option>
            @endforeach
        </select>
    </div>
    <div>Jam Mulai Baru: <input type="time" name="jam_mulai_baru" required></div>
    <div>Jam Selesai Baru: <input type="time" name="jam_selesai_baru" required></div>
    <button type="submit">Kirim Permintaan</button>
</form>