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
                    ->select(
                        'kelas.nama_kelas',
                        'kelas.tingkat_kelas',
                        'kelas.kuota',
                        'kelas.id',
                        'kelas.thn_masuk',
                        'kelas.thn_keluar',
                        'gurus.nama'
                    )
                    ->join('gurus', 'gurus.id', '=', 'kelas.wali_kelas')
                    ->get();
       return $data;
    }

    public function tambah_data($request)
    {

        for($i=0;$i<count($request->siswa);$i++){
            
            $check = Absensi::where([
                        'id_siswa'  => $request->siswa[$i],
                        'id_kelas'  => $request->kelas, 
                        'tanggal'   => date('Y-m-d')
                    ])->get();

            if(count($check) == 0 && $request->status[$i] != "Hadir"){
                
                $absen              = new Absensi;
                $absen->id_siswa    = $request->siswa[$i];
                $absen->id_kelas    = $request->kelas;
                $absen->tanggal     = date('Y-m-d');
                $absen->status      = $request->status[$i];
                $absen->keterangan  = $request->status[$i];
                $absen->save();

            }
        }
    }
}

