<h1>Impor Jadwal dari Excel</h1>
<p>Pastikan header file Excel Anda: `mata_kuliah`, `dosen_email`, `kode_ruangan`, `nama_prodi`, `angkatan`, `hari`, `jam_mulai`, `jam_selesai`</p>
<a href="/template-jadwal.xlsx" download>Download Template</a>
<hr>
<form action="{{ route('admin.schedules.import.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" required>
    <button type="submit">Impor</button>
</form>