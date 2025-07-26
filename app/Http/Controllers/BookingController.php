<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomRequest;
use App\Models\Schedule;
use App\Models\AccessLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan form untuk membuat permintaan peminjaman (booking acara).
     */
    public function create()
    {
        $rooms = Room::orderBy('nama_ruangan')->get();
        return view('booking.create', compact('rooms'));
    }

    /**
     * Menyimpan permintaan peminjaman baru (booking acara).
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'keperluan' => 'required|string|max:255',
            'waktu_mulai' => 'required|date|after:now',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        RoomRequest::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'keperluan' => $request->keperluan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        // Perbaikan: auth()->user() bukan auth::user()
        $dashboardRoute = auth::user()->role . '.dashboard';
        
        return redirect()->route($dashboardRoute)
                       ->with('success', 'Permintaan peminjaman ruangan berhasil dikirim.');
    }

    /**
     * (METHOD YANG HILANG) Menampilkan halaman simulasi scan.
     */
    public function showScanPage()
    {
        $rooms = Room::all();
        return view('booking.scan', compact('rooms'));
    }

    /**
     * (METHOD YANG HILANG) Menangani aksi "scan" dan membuat permintaan.
     */
    public function handleScan(Room $room)
    {
        $user = auth::user();

        // Logika khusus untuk Petugas Kebersihan
        if ($user->role === 'petugas') {
            AccessLog::create([
                'user_id' => $user->id,
                'room_id' => $room->id,
                'action'  => 'PETUGAS_SCAN_OPEN',
            ]);
            return redirect()->route('petugas.dashboard')
                        ->with('success', 'Akses berhasil. Pintu untuk ruangan ' . $room->nama_ruangan . ' telah dibuka.');
        }

        // Logika untuk Dosen dan Mahasiswa
        RoomRequest::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'keperluan' => 'Akses via QR Scan',
            'waktu_mulai' => now(),
            'waktu_selesai' => now()->addHours(1),
            'status' => 'pending',
        ]);

        return redirect()->route($user->role . '.dashboard')
                    ->with('success', 'Permintaan akses untuk ruangan ' . $room->nama_ruangan . ' telah dikirim ke Admin.');
    }

        // Method BARU untuk menampilkan halaman kamera scanner
    public function showScanner()
    {
        return view('booking.scanner');
    }

    // Method BARU untuk memeriksa jadwal via AJAX
    public function checkSchedule(Request $request)
    {
        $request->validate(['room_code' => 'required|string']);

        $room = Room::where('code', $request->room_code)->first();

        if (!$room) {
            return response()->json(['status' => 'error', 'message' => 'Ruangan tidak ditemukan.']);
        }

        // Cek apakah ada jadwal untuk user ini, di ruangan ini, pada saat ini
        $now = Carbon::now();
        $schedule = Schedule::where('user_id', auth::id())
            ->where('room_id', $room->id)
            ->where('hari', $now->translatedFormat('l')) // 'l' untuk nama hari (e.g., 'Senin')
            ->where('jam_mulai', '<=', $now->format('H:i:s'))
            ->where('jam_selesai', '>=', $now->format('H:i:s'))
            ->first();

        if ($schedule) {
            // Jika jadwal ditemukan
            return response()->json([
                'status' => 'match',
                'message' => 'Anda memiliki jadwal mengajar di ruangan ini sekarang. Minta akses?',
                'room_id' => $room->id,
            ]);
        } else {
            // Jika tidak ada jadwal
            return response()->json([
                'status' => 'no_match',
                'message' => 'Anda tidak memiliki jadwal di ruangan ini. Tetap minta akses? (Memerlukan persetujuan Admin)',
                'room_id' => $room->id,
            ]);
        }
    }
}
