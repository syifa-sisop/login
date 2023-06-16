<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelasSiswa;

class SiswaKelasController extends Controller
{
    public function show($id)
    {
        $this->model    = new KelasSiswa;
        $resource       = $this->model->ambil_data();

        return view('Admin/SiswaKelas')->with([
            'resource'  =>$resource, 
            'kelas'     =>$id,
            'user'      => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $this->model = new KelasSiswa;
        $this->model->tambah_data($request);

        return redirect()->route('kelas/'.$request->kelas)->with('success', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $this->model = new KelasSiswa;
        $this->model->delete_data($id);
        session()->flash('notif', array('success' => true, 'msgaction' => 'Hapus Data Berhasil!'));
        
        return redirect(url()->previous());
    }
}
