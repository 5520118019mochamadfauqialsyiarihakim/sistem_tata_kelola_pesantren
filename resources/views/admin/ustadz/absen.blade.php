@extends('template_backend.home')
@section('heading', 'Absensi Santri')
@section('page')
    <li class="breadcrumb-item active">Absensi Santri</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Santri</th>
                    <th>Cek Absensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ustadz as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_santri }}</td>
                        <td>
                            <a href="{{ route('ustadz.kehadiran', Crypt::encrypt($data->id)) }}" class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Details</a>
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
        $("#AbsensiUstadz").addClass("active");
    </script>
@endsection