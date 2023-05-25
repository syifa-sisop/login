<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'tanggal',
        'status',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsToMany('App\Models\Siswa');
    }

    public function tampil_absen()
    {
        $data       = DB::table('kelas')
                    ->join('gurus', 'gurus.id', '=', 'kelas.wali_kelas')
                    ->get(['kelas.nama_kelas','kelas.tingkat_kelas','kelas.kuota','kelas.id','kelas.thn_masuk','kelas.thn_keluar','gurus.nama']);
        return $data;
    }
}

