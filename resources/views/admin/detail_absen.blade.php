@extends('layout.main')

@section('judul')
  Halaman Detail Rekap Absensi
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

                    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Data Rekap Absensi</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="table-responsive">

                            <table id="table1" class="table table-bordred table-striped">
                                <thead>
                                    <tr>
                                        <th  class="text-center">No</th>
                                        <th >NISN</th>
                                        <th >Nama Siswa</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $siswa)
                                    <tr>
                                        <td class="text-center">{{ $index+1 }}</td>
                                        <td>{{ $siswa->nisn}}</td>
                                        <td>{{ $siswa->nama}}</td>
                                        <td>{{ $siswa->tanggal}}</td>
                                        <td>{{ $siswa->status}}</td>
                           
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination pull-right">

                        </ul>
                    </div>
                    <div class="panel-footer">
                        
                    </div>
                </div>
            </div>

        </div><!--/.row-->
    </div>

            </div>
@endsection