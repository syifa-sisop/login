<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\KelasSiswa;
use DB; 

class SiswaKelasController extends Controller
{
    public function add($id){
        $resource=Siswa::get();
        return view('Admin/SiswaKelas',['resource'=>$resource, 'kelas'=>$id,'user' => Auth::user()]);
    }
    public function create(Request $request)
    {
        $check = KelasSiswa::where(['id_kelas' => $request->kelas, 'id_siswa' => $request->siswa])->get();
        if($check->count()>0){
            session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Data Telah Ada!'));
            return redirect('/admin/kelas');
        }
        else{
            $SK = new KelasSiswa;
            $SK->id_siswa = $request->siswa;
            $SK->id_kelas = $request->kelas;
            if($SK->save()){
                session()->flash('notif', array('success' => true, 'msgaction' => 'Tambah Data Berhasil!'));
            }
            else{
                session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Silahkan Ulangi!'));
            }
            return redirect('kelas/'.$request->kelas);
        }
    }
    public function delete($id){
        KelasSiswa::find($id)->delete();
        session()->flash('notif', array('success' => true, 'msgaction' => 'Hapus Data Berhasil!'));
        return redirect(url()->previous());
    }
}
