<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\KelasSiswa;
use DB; 

class SiswaKelasController extends Controller
{
    public function show($id)
    {
        $resource   = Siswa::get();
        return view('Admin/SiswaKelas')->with([
            'resource'  => $resource, 
            'kelas'     => $id,
            'user'      => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $this->model = new KelasSiswa;
        $this->model->tambah_data($request);
        return redirect('kelas/'.$request->kelas);
    }

    public function delete($id)
    {
        KelasSiswa::find($id)->delete();
        session()->flash('notif', array('success' => true, 'msgaction' => 'Hapus Data Berhasil!'));
        return redirect(url()->previous());
    }
}
