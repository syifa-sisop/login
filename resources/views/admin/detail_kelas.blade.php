@extends('layout.main')

@section('judul')
  Halaman Detail Kelas
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
                <div class="panel-heading">Data Kelas</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table id="absensi" class="table table-bordred table-striped">
                                <thead>
                                    <tr>
                                        <th width="2%"><input type="checkbox" id="checkall" /> </th>
                                        <th width="3%" class="text-center">No</th>
                                        <th width="30%">NISN</th>
                                        <th width="30%">Nama Siswa</th>
                                        <th width="15%" class="text-center">Jenis Kelamin</th>
                                        <th width="5%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resource->siswa as $index => $siswa)
                                    <tr>
                                        <td><input type="checkbox" class="checkthis" /></td>
                                        <td class="text-center">{{ $index+1 }}</td>
                                        <td>{{ $siswa->nisn}}</td>
                                        <td>{{ $siswa->nama}}</td>
                                        <td class="text-center">@if($siswa->jenis_kelamin=="Laki-Laki"){{ "Laki-Laki" }}@else{{ "Perempuan" }}@endif</td>
                                        <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><button data-aksi="SiswaKelas" data-id="{{$siswa->pivot->id_siswa_kelas}}" class="delete-button btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination pull-right">

                        </ul>
                    </div>
                    <div class="panel-footer">
                        <form action="{{ url('/siswakelas/'.$resource->id_kelas) }}" method="GET"> 
                            <p data-placement="top" data-toggle="tooltip" title="Add" class="pull-right">


                                <button class="btn btn-primary btn-sm" data-title="Add" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <p class="back-link">&copy; <?php echo date('Y') ?> Arif Nurdiansyah</p>
            </div>
        </div><!--/.row-->
    </div>




        </div>
@endsection