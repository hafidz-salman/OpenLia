<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('prodi')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $roles = ['admin', 'dosen', 'mahasiswa', 'petugas'];
        return view('admin.users.create', compact('prodis', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'prodi_id' => 'nullable|exists:prodis,id',
            'tahun_masuk' => 'nullable|integer|min:2000',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'prodi_id' => $request->prodi_id,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil dibuat.');
    }

    public function edit(User $user)
    {
        $prodis = Prodi::all();
        $roles = ['admin', 'dosen', 'mahasiswa', 'petugas'];
        return view('admin.users.edit', compact('user', 'prodis', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8', // Password opsional saat update
            'role' => 'required|string',
            'prodi_id' => 'nullable|exists:prodis,id',
            'tahun_masuk' => 'nullable|integer|min:2000',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        if (Auth::id() == $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}