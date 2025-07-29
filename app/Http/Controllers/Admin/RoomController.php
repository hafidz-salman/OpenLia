<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\AccessLog;
use App\Imports\RoomsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Menampilkan daftar semua ruangan dengan fungsionalitas filter.
     */
    public function index(Request $request) // --- PERBAIKAN DI SINI --- (Nama method menjadi index)
    {
        // Ambil data unik untuk filter dropdown
        $gedungs = Room::select('gedung')->distinct()->orderBy('gedung')->get();
        $statuses = Room::select('status')->distinct()->orderBy('status')->get();

        // Query dasar
        $query = Room::query();

        // Terapkan filter jika ada input dari pengguna
        if ($request->filled('search')) {
            $query->where('nama_ruangan', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('gedung')) {
            $query->where('gedung', $request->gedung);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $rooms = $query->latest()->get();

        // Kirim semua data yang dibutuhkan ke view
        return view('admin.rooms.index', compact('rooms', 'gedungs', 'statuses'));
    }

    /**
     * Menampilkan form untuk membuat ruangan baru.
     */
    public function create()
    {
        $facilityTemplates = [
            'Kelas' => ['Proyektor', 'Papan Tulis', 'AC', 'Meja & Kursi'],
            'Lab Komputer' => ['Komputer', 'Jaringan Internet', 'Proyektor', 'AC'],
            'Bengkel' => ['Peralatan Bengkel', 'Area Kerja', 'Listrik Daya Tinggi'],
            'Ruang Meeting' => ['Meja Meeting', 'Proyektor/TV', 'Papan Tulis', 'AC'],
        ];
        return view('admin.rooms.create', compact('facilityTemplates'));
    }

    /**
     * Menyimpan ruangan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'gedung' => 'required|string|max:255',
            'status' => 'required|string',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|array',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('foto');
        $data['code'] = 'R' . strtoupper(Str::random(8));

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('room_photos', 'public');
            $data['foto'] = $path;
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu ruangan beserta QR Code-nya.
     */
    public function show(Room $room)
    {
        $qrCode = QrCode::size(250)->generate($room->code);
        return view('admin.rooms.show', compact('room', 'qrCode'));
    }

    /**
     * Menampilkan form untuk mengedit data ruangan.
     */
    public function edit(Room $room)
    {
        $facilityTemplates = [
            'Kelas' => ['Proyektor', 'Papan Tulis', 'AC', 'Meja & Kursi'],
            'Lab Komputer' => ['Komputer', 'Jaringan Internet', 'Proyektor', 'AC'],
            'Bengkel' => ['Peralatan Bengkel', 'Area Kerja', 'Listrik Daya Tinggi'],
            'Ruang Meeting' => ['Meja Meeting', 'Proyektor/TV', 'Papan Tulis', 'AC'],
        ];
        return view('admin.rooms.edit', compact('room', 'facilityTemplates'));
    }

    /**
     * Mengupdate data ruangan di database.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'gedung' => 'required|string|max:255',
            'status' => 'required|string',
            'code' => 'required|string|max:255|unique:rooms,code,' . $room->id,
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|array',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hapus_foto' => 'nullable|boolean',
        ]);

        $data = $request->except(['foto', 'hapus_foto']);

        if ($request->boolean('hapus_foto') && $room->foto) {
            Storage::disk('public')->delete($room->foto);
            $data['foto'] = null;
        }
        else if ($request->hasFile('foto')) {
            if ($room->foto) {
                Storage::disk('public')->delete($room->foto);
            }
            $path = $request->file('foto')->store('room_photos', 'public');
            $data['foto'] = $path;
        }

        $room->update($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Data ruangan berhasil diupdate.');
    }

    /**
     * Menghapus data ruangan dari database.
     */
    public function destroy(Room $room)
    {
        if ($room->foto) {
            Storage::disk('public')->delete($room->foto);
        }
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Data ruangan berhasil dihapus.');
    }

    public function overrideAccess(Room $room)
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'action'  => 'OVERRIDE_OPEN',
        ]);
        return back()->with('success', 'Aksi override untuk ruangan ' . $room->nama_ruangan . ' berhasil dicatat.');
    }
    
    public function showImportForm()
    {
        return view('admin.rooms.import');
    }

    public function importExcel(Request $request)
    {
        $request->validate(['excel_file' => 'required|mimes:xlsx,xls']);
        Excel::import(new RoomsImport, $request->file('excel_file'));
        return redirect()->route('admin.rooms.index')->with('success', 'Jadwal berhasil diimpor.');
    }
}
