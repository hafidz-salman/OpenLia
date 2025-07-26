<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\RoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil riwayat permintaan peminjaman ruangan
        $roomRequests = RoomRequest::where('user_id', $userId)
                                    ->with('room') // Ambil data ruangan terkait
                                    ->latest()
                                    ->get();

        return view('mahasiswa.history.index', compact('roomRequests'));
    }
}
