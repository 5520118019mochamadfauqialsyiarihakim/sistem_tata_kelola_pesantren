@extends('template_backend.home')
@section('heading', 'Details Ustadz')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('ustadz.index') }}">Ustadz/Ustadzah</a></li>
  <li class="breadcrumb-item active">Details Ustadz/Ustadzah</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route("ustadz.mapel", Crypt::encrypt($ustadz->mapel_id)) }}" class="btn btn-default btn-sm"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
        </div>
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-4">
                    <img src="{{ asset($ustadz->foto) }}" class="card-img img-details" alt="...">
                </div>
                <div class="col-md-1 mb-4"></div>
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">Nama : {{ $ustadz->nama_ustadz }}</h5>
                    <h5 class="card-title card-text mb-2">NIP : {{ $ustadz->nip }}</h5>
                    <h5 class="card-title card-text mb-2">No Id Card : {{ $ustadz->id_card }}</h5>
                    <h5 class="card-title card-text mb-2">Ustadz/Ustadzah Mapel : {{ $ustadz->mapel->nama_mapel }}</h5>
                    <h5 class="card-title card-text mb-2">Kode Jadwal : {{ $ustadz->kode }}</h5>
                    @if ($ustadz->jk == 'L')
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Laki-laki</h5>
                    @else
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Perempuan</h5>
                    @endif
                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $ustadz->tmp_lahir }}</h5>
                    <h5 class="card-title card-text mb-2">Tanggal Lahir : {{ date('l, d F Y', strtotime($ustadz->tgl_lahir)) }}</h5>
                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $ustadz->telp }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataUstadz").addClass("active");
    </script>
@endsection