<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\KelasSiswa;
use DB; 

class KelasController extends Controller
{
    public function index()
    {
        $guru   = Guru::all();
        $guru2   = Guru::all();
        $kelas   = Kelas::all();
        $kelas2  = Kelas::paginate(5);

        $this->model = new Kelas;
        $data = $this->model->show();
        
        return view('admin.kelas')->with([
            'user' => Auth::user(),
            'kelas2' => $kelas2,
            'guru'  => $guru,
            'guru2' => $guru2,
            'data'  => $data,

        ]);
    }
    public function store(Request $request)
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
            return redirect()->route('kelas.index');
        }

    }

    public function update(Request $request, $id)
    {
        $guru  = Guru::find($id);
        $kelas = Kelas::find($id);
        $input  = $request->all();
        $kelas->fill($input)->save();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil diupdate!');
    }

    public function show($id){
        $resource = Kelas::find($id);
        
        $this->model = new Kelas;
        $data = $this->model->tampil_siswa($id);

        return view('Admin/detail_kelas', ['resource'=>$resource, 'user' => Auth::user(), 'data' =>$data]);
    }

     public function destroy($id)
    {
        $kelas     = Kelas::find($id);

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }

    public function delete($id)
    {
        $siswa     = KelasSiswa::find($id);
 
        $siswa->delete();

        return redirect()->route('kelas.show')->with('success', 'Data berhasil dihapus!');
    }

}
