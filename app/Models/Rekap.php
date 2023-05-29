<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Rekap extends Model
{
    public function show()
    {
        $data = DB::table('kelas')
                    ->join('gurus', 'gurus.id', '=', 'kelas.wali_kelas')
                    ->get(['kelas.nama_kelas','kelas.tingkat_kelas','kelas.kuota','kelas.id','kelas.thn_masuk','kelas.thn_keluar','gurus.nama']);
        return $data;
    }

    public function tampil_data($id)
    {
        $data = DB::table('absensis')
                    ->join('kelas', 'kelas.id', '=', 'absensis.id_kelas')
                    ->join('siswas', 'siswas.id', '=', 'absensis.id_siswa')
                    ->where('absensis.id_kelas',$id)
                    ->get(['absensis.id','siswas.nama','siswas.nisn','siswas.jenis_kelamin', 'absensis.status', 'absensis.tanggal']);
        return $data;
    }
}
