@extends('template_backend.home')
@section('heading', 'Trash Ustadz')
@section('page')
  <li class="breadcrumb-item active">Trash Ustadz/Ustadzah</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Trash Data Ustadz/Ustadzah</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Ustadz/Ustadzah</th>
                    <th>Id Card</th>
                    <th>Ustadz/Ustadzah Mapel</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ustadz as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama_ustadz }}</td>
                    <td>{{ $data->id_card }}</td>
                    <td>{{ $data->mapel->nama_mapel }}</td>
                    <td>
                        <a href="{{ asset($data->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->nama_ustadz }}" data-gallery="gallery" data-footer='<a href="{{ route('ustadz.ubah-foto', Crypt::encrypt($data->id)) }}" id="linkFotoUstadz" class="btn btn-link btn-block btn-light"><i class="nav-icon fas fa-file-upload"></i> &nbsp; Ubah Foto</a>'>
                            <img src="{{ asset($data->foto) }}" width="130px" class="img-fluid mb-2">
                        </a>
                        {{-- https://siakad.didev.id/ustadz/ubah-foto/{{$data->id}} --}}
                    </td>
                    <td>
                        <form action="{{ route('ustadz.kill', $data->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('ustadz.restore', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-undo"></i> &nbsp; Restore</a>
                            <button class="btn btn-danger btn-sm mt-2"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#ViewTrash").addClass("active");
        $("#liViewTrash").addClass("menu-open");
        $("#TrashUstadz").addClass("active");
    </script>
@endsection