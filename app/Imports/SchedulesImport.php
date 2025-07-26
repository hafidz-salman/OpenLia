<?php

namespace App\Imports;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Room;
use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SchedulesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dosen = User::where('email', $row['dosen_email'])->where('role', 'dosen')->first();
        $ruangan = Room::where('code', $row['kode_ruangan'])->first();
        $prodi = Prodi::where('nama_prodi', $row['nama_prodi'])->first();

        if ($dosen && $ruangan && $prodi) {
            return new Schedule([
                'mata_kuliah' => $row['mata_kuliah'],
                'user_id'     => $dosen->id,
                'room_id'     => $ruangan->id,
                'prodi_id'    => $prodi->id,
                'angkatan'    => $row['angkatan'],
                'hari'        => $row['hari'],
                'jam_mulai'   => $row['jam_mulai'],
                'jam_selesai' => $row['jam_selesai'],
            ]);
        }
        
        return null;
    }
}