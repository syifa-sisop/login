<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rekap;
use App\Models\Kelas;

class RekapController extends Controller
{
    public function index()
    {
        $this->model    = new Rekap;
        $this->kelas    = new Kelas;
        $data           = $this->model->show();
        $kelas2         = $this->kelas->pagination();
        
        return view('admin.rekap')->with([
            'user'      => Auth::user(),
            'data'      => $data,
            'kelas2'    => $kelas2,
        ]);
    }

    public function show($id)
    {
        $this->model    = new Rekap;
        $data           = $this->model->tampil_data($id);
        
        return view('Admin/detail_absen')->with([
            'user' => Auth::user(), 
            'data' =>$data,
        ]);
    }
}
