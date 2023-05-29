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
        $kelas2  = Kelas::paginate(5);

        $this->model = new Rekap;
        $data = $this->model->show();
        
        
        return view('admin.rekap')->with([
            'user'      => Auth::user(),
            'data'      => $data,
            'kelas2'    => $kelas2,
           
        ]);
    }

    public function show($id)
    {
        $this->model = new Rekap;
        $data = $this->model->tampil_data($id);

        return view('Admin/detail_absen', ['user' => Auth::user(), 'data' =>$data]);
    }
}
