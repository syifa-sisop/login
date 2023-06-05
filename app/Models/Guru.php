<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nip',
        'jenis_kelamin'
    ];

    public function tambah_data($request)
    {
        $request->validate([
            'nama'          => 'required',
            'nip'           => 'required',
            'jenis_kelamin' => 'required'
        ]);
        Guru::create($request->all());
    }
}
