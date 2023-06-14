@extends('layout.main')

@section('judul')
  Halaman Tambah Data Siswa Kelas
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

          @if(session()->exists('notif'))
          @if(session()->get('notif')['success'])
          {!! 
          '<div class="alert alert-success alert-dismissable"> 
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <strong>Sukses! </strong>'. session()->get('notif')['msgaction'] .'
          </div>' 
          !!}
          @else
          {!! 
          '<div class="alert alert-danger alert-dismissable"> 
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <strong>Gagal! </strong>'. session()->get('notif')['msgaction'] .'
          </div>' 
          !!}
          @endif
          @endif

          <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Data Siswa</div>
                <div class="panel-body">


                            <table  id="table1" class="table table-bordred table-striped">
                                <thead>
                                    <tr>
                                        <th  class="text-center">No</th>
                                        <th >NISN</th>
                                        <th >Nama Siswa</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th  class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resource as $index=>$res)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$res->nisn}}</td>
                                        <td>{{$res->nama}}</td>
                                        <td>{{$res->jenis_kelamin}}</td>
                                        <td><form action="{{url('/siswakelas/')}}" method="POST"><input type="hidden" name="kelas" value="{{$kelas}}"><input type="hidden" name="siswa" value="{{$res->id}}"><button class="btn btn-primary" type="submit">Tambahkan Ke Kelas</button>{!! csrf_field() !!}</form></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                        </div>
        </div>
@endsection