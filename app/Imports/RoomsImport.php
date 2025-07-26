<?php

namespace App\Imports;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class RoomsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Logika baru untuk status:
        // Cek apakah kolom 'status' ada dan tidak kosong. Jika ya, gunakan nilainya.
        // Jika tidak, maka gunakan 'Tersedia'.
        $status = !empty($row['status']) ? $row['status'] : 'Tersedia';

        return new Room([
            'nama_ruangan' => $row['nama_ruangan'],
            'gedung'       => $row['gedung'],
            'deskripsi'    => $row['deskripsi'],
            'status'       => $status, // Gunakan variabel status yang sudah diproses
            'code'         => 'R' . strtoupper(Str::random(8)),
        ]);
    }
}