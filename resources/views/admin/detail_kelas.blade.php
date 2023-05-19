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
                            <form action="{{ url('/siswakelas/'.$resource->id) }}" method="GET"> 
                            <p data-placement="top" data-toggle="tooltip" title="Add" class="pull-right">


                                <button class="btn btn-primary btn-sm" data-title="Add" type="submit">
                                    <span class="fas fa-plus">Tambah Siswa</span>
                                </button>
                            </p>
                        </form>
                            <table id="table1" class="table table-bordred table-striped">
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
                                    @foreach($data as $index => $siswa)
                                    <tr>
                                        <td class="text-center">{{ $index+1 }}</td>
                                        <td>{{ $siswa->nisn}}</td>
                                        <td>{{ $siswa->nama}}</td>
                                        <td>{{ $siswa->jenis_kelamin}}</td>
                                        <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><button data-aksi="SiswaKelas" data-id="{{$siswa->id}}" class="delete-button btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete{{$siswa->id}}"><span class="fas fa-trash"></span> Delete</button></p></td>
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
 @foreach($data as $index => $siswa)
    <div class="modal fade" id="delete{{$siswa->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data Siswa dalam Kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! Form::model($data, ['method' => 'delete', 'route' => ['kelas.destroy', $siswa->id] ]) !!}
                <h6 class="text-center">Apakah Anda Yakin Untuk Menghapus Data Ini ?</h4>
              


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              {{Form::button('<i class="fa fa-trash"></i> Delete', ['class' => 'btn btn-danger', 'type' =>'submit'])}}
              {!! Form::close() !!}
          
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      @endforeach
        </div>
@endsection