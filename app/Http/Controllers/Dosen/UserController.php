<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // 1. Ambil prodi_id dari dosen yang sedang login
        $prodiId = Auth::user()->prodi_id;

        // 2. Jika dosen tidak punya prodi, kembalikan daftar kosong
        if (!$prodiId) {
            $users = collect(); // Membuat koleksi kosong
        } else {
            // 3. Cari semua user yang punya prodi_id yang sama
            $users = User::where('prodi_id', $prodiId)->orderBy('name')->get();
        }

        // 4. Kirim data ke view
        return view('dosen.users.index', compact('users'));
    }
}