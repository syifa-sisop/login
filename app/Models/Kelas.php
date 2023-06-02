<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tingkat_kelas',
        'nama_kelas',
        'kuota',
        'thn_masuk',
        'thn_keluar',
        'wali_kelas',
    ];
    
    public $timestamps  = false;

    public function absen()
    {    
        return $this->belongsToMany('App\Models\Siswa', 'absensis', 'id_kelas', 'id_siswa')->withPivot('status', 'tanggal', 'keterangan')->wherePivot('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'));
    }

    public function Siswa()
    {
        return $this->belongsToMany('App\Models\Siswa', 'kelas_siswas', 'id_kelas', 'id_siswa')->withPivot('id');
    }

    public function show()
    {
        $data = DB::table('kelas')
                    ->join('gurus', 'gurus.id', '=', 'kelas.wali_kelas')
                    ->get(['kelas.nama_kelas','kelas.tingkat_kelas','kelas.kuota','kelas.id','kelas.thn_masuk','kelas.thn_keluar','gurus.nama']);

        return $data;
    }

    public function tampil_siswa($id)
    {
        //$kelas     = Kelas::find($id);
        $data = DB::table('kelas_siswas')
                    ->join('kelas', 'kelas.id', '=', 'kelas_siswas.id_kelas')
                    ->join('siswas', 'siswas.id', '=', 'kelas_siswas.id_siswa')
                    ->where('kelas_siswas.id_kelas',$id)
                    ->get(['kelas_siswas.id','siswas.nama','siswas.nisn','siswas.jenis_kelamin']);
        return $data;
    }

    public function tambah_data($request)
    {
        $check = Kelas::where(['tingkat_kelas' => $request->tingkat_kelas, 
            'nama_kelas' => $request->nama_kelas, 'thn_masuk' => $request->thn_masuk, 'thn_keluar' => $request->thn_keluar])->get();

        if($check->count()>0){
            session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Data Telah Ada!'));
            return redirect()->route('kelas.index');
        }
        else{
            $Kelas = new Kelas;
            $Kelas->tingkat_kelas = $request->tingkat_kelas;
            $Kelas->nama_kelas = $request->nama_kelas;
            $Kelas->kuota = $request->kuota;
            $Kelas->thn_masuk = $request->thn_masuk;
            $Kelas->thn_keluar = $request->thn_keluar;
            $Kelas->wali_kelas = $request->wali_kelas;
            if($Kelas->save()){
                session()->flash('notif', array('success' => true, 'msgaction' => 'Tambah Data Berhasil!'));
            }
            else{
                session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Silahkan Ulangi!'));
            }
          
        }
    }
}
