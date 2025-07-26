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
     * Menampilkan daftar semua ruangan.
     */
    public function index()
    {
        $rooms = Room::latest()->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Menampilkan form untuk membuat ruangan baru.
     */
    public function create()
    {
        // Template fasilitas untuk mempermudah input
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

        // 1. Generate Kode Unik Otomatis
        $data['code'] = 'R' . strtoupper(Str::random(8));

        // 2. Handle Upload Foto
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/room_photos');
            $data['foto'] = $path;
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan baru berhasil ditambahkan.');
    }

        /**
     * Menangani proses impor file Excel.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new RoomsImport, $request->file('excel_file'));
        } catch (\Exception $e) {
            // Jika ada error saat impor, kembali dengan pesan error
            return back()->with('error', 'Terjadi kesalahan saat mengimpor file: ' . $e->getMessage());
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Data ruangan berhasil diimpor dari Excel.');
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

        // Skenario 1: Checkbox "Hapus foto" dicentang
        if ($request->boolean('hapus_foto') && $room->foto) {
            Storage::delete($room->foto);
            $data['foto'] = null;
        }
        // Skenario 2: Ada file foto baru yang di-upload
        else if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($room->foto) {
                Storage::delete($room->foto);
            }
            $path = $request->file('foto')->store('public/room_photos');
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
        // Hapus foto dari storage sebelum menghapus record database
        if ($room->foto) {
            Storage::delete($room->foto);
        }
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Data ruangan berhasil dihapus.');
    }

    public function overrideAccess(Room $room)
    {
        // Catat aksi ke dalam log
        AccessLog::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'action'  => 'OVERRIDE_OPEN',
        ]);

        return back()->with('success', 'Aksi override untuk ruangan ' . $room->nama_ruangan . ' berhasil dicatat.');
    }
}