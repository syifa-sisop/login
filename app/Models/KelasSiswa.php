<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'id_kelas',
    ];

    public function tambah_data($request)
    {
        $check = KelasSiswa::where(['id_kelas' => $request->kelas, 'id_siswa' => $request->siswa])->get();
        if($check->count()>0){
            session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Data Telah Ada!'));
            return redirect('kelas.show');
        }
        else{
            $Siswa = new KelasSiswa;
            $Siswa->id_siswa = $request->siswa;
            $Siswa->id_kelas = $request->kelas;
            if($Siswa->save()){
                session()->flash('notif', array('success' => true, 'msgaction' => 'Tambah Data Berhasil!'));
            }
            else{
                session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Silahkan Ulangi!'));
            }
            return redirect('kelas/'.$request->kelas);
        }
    }
}
