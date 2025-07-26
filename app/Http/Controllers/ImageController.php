<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    /**
     * Menampilkan file gambar dari storage.
     */
    public function show($path)
    {
        // Path lengkap ke file di dalam storage
        $fullPath = 'public/' . $path;

        // Periksa apakah file ada
        if (!Storage::exists($fullPath)) {
            abort(404);
        }

        // Ambil file dari storage
        $file = Storage::get($fullPath);
        // Dapatkan tipe mime file (misal: image/jpeg)
        $type = Storage::mimeType($fullPath);

        // Buat respons untuk menampilkan file sebagai gambar
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
