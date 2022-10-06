@extends('template_backend.home')
@section('heading', 'Jadwal Ustadz')
@section('heading')
    Jadwal Ustadz {{ Auth::user()->ustadz(Auth::user()->id_card)->nama_ustadz }}
@endsection
@section('page')
  <li class="breadcrumb-item active">Jadwal Ustadz/Ustadzah</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Kelas</th>
                    <th>Jam Mengajar</th>
                    <th>Ruang Kelas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $data)
                <tr>
                    <td>{{ $data->hari->nama_hari }}</td>
                    <td>{{ $data->kelas->nama_kelas }}</td>
                    <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                    <td>{{ $data->ruang->nama_ruang }}</td>
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
        $("#JadwalUstadz").addClass("active");
    </script>
@endsection