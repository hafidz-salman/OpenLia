<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::all(); // Ambil semua data prodi
        return view('admin.prodi.index', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodis',
            'deskripsi' => 'nullable|string', // Tambahkan validasi untuk deskripsi
        ]);

        Prodi::create($request->all()); // Gunakan all() karena sudah aman dengan $fillable

        return redirect()->route('admin.prodi.index')->with('success', 'Prodi baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        return view('admin.prodi.show', compact('prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        return view('admin.prodi.edit', compact('prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodis,nama_prodi,' . $prodi->id,
            'deskripsi' => 'nullable|string', // Tambahkan validasi untuk deskripsi
        ]);

        $prodi->update($request->all()); // Gunakan all()

        return redirect()->route('admin.prodi.index')->with('success', 'Data prodi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('admin.prodi.index')->with('success', 'Data prodi berhasil dihapus.');
    }
}
