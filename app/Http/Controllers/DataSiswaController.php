<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
        $this->model   = new Siswa;
        $siswa         = $this->model->search($request);

        return view('admin.siswa')->with([
            'user'     => Auth::user(),
            'siswa'    => $siswa,
        ]);
    }

    public function store(Request $request)
    {
        $this->model = new Siswa;
        $this->model->tambah_data($request);
        return redirect()->route('datasiswa')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->model = new Siswa;
        $this->model->update_data($request,$id);
        return redirect()->route('datasiswa')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $this->model = new Siswa;
        $this->model->delete_data($id);
        return redirect()->route('datasiswa')->with('success', 'Data berhasil dihapus!');
    }

}

