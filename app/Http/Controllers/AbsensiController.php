<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\Kelas;

class AbsensiController extends Controller
{
     public function index()
     {

        $kelas2         = Kelas::paginate(5);
        $this->model    = new Absensi;
        $data           = $this->model->tampil_absen();

        return view('admin/listkelas')->with([
            'kelas2'    =>$kelas2, 
            'user'      => Auth::user(), 
            'data'      => $data
        ]);
    }

    public function show($id)
    {
        $kelas2 = Kelas::find($id);
        return view('admin/absensi')->with([
            'kelas2'    => $kelas2,
            'user'      => Auth::user(),
        ]);
    }

    public function create(Request $request)
    {
        $this->model = new Absensi;  
        $this->model->tambah_data($request);
        return redirect('/absensi');
    }
}
