@extends('layout.main')

@section('judul')
  Halaman Absensi List Kelas
@endsection

@section('isi')

<div class="card">
        <div class="card-header">
          <h3 class="card-title">Selamat Datang, {{ $user->name }}</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

          <div>
          @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            
                   {{ session('success') }}
          </div>
          @endif
        </div>

        <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Tingkat Kelas</th>
                      <th>Nama Kelas</th>
                      <th>Kuota</th>
                      <th>Tahun Pelajaran</th>
                      <th>Wali Kelas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $kelas)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $kelas->tingkat_kelas }}</td>
                      <td>{{ $kelas->nama_kelas }}</td>
                      <td>{{ $kelas->kuota }}</td>
                      <td>{{ $kelas->thn_masuk }}/{{ $kelas->thn_keluar }}</td>
                      <td>{{ $kelas->nama }}</td>

                      <td>
                        <a href="{{url('absensi/'.$kelas->id)}}"><button type="button" class="btn btn-success" > <i class="fas fa-regular fa-calendar-check"></i>  Absensi</button></a>
                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table><br>
                {{ $list->links()}}
                <br>
      </div>
@endsection
