@extends('template_backend.home')
@section('heading', 'Absensi Ustadz')
@section('page')
    <li class="breadcrumb-item active"><a href="{{ route('ustadz.absensi') }}">Absensi Ustadz/Ustadzah</a></li>
    <li class="breadcrumb-item active">{{ $ustadz->nama_ustadz }}</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('ustadz.index') }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absen as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('l, d F Y', strtotime($data->tanggal)) }}</td>
                    <td>{{ $data->kehadiran->ket }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
@endsection
@section('script')
    <script>
        $("#AbsensiUstadz").addClass("active");
    </script>
@endsection