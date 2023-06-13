<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;

class AbsensiController extends Controller
{
     public function index()
     {
        $this->model    = new Absensi;
        $data           = $this->model->tampil_absen();
        $list           = $this->model->pagination();

        return view('admin/listkelas')->with([
            'list'      =>$list, 
            'user'      => Auth::user(), 
            'data'      => $data,
        ]);
    }

    public function show($id)
    {
        $this->model    = new Absensi;
        $kelas          = $this->model->detail($id);

        return view('admin/absensi')->with([        
            'kelas'     =>$kelas,
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
