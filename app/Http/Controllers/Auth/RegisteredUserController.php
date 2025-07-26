<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Prodi; // <-- 1. Import model Prodi
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // 2. Ambil semua data prodi untuk ditampilkan di form
        $prodis = Prodi::orderBy('nama_prodi')->get();
        return view('auth.register', compact('prodis'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 3. Tambahkan validasi untuk prodi dan tahun masuk
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'prodi_id' => ['required', 'exists:prodis,id'],
            'tahun_masuk' => ['required', 'integer', 'min:2015', 'max:'.date('Y')],
        ]);

        // 4. Simpan data baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', // Otomatis sebagai mahasiswa
            'prodi_id' => $request->prodi_id,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Arahkan ke dashboard yang sesuai
        return redirect()->route('mahasiswa.dashboard');
    }
}
