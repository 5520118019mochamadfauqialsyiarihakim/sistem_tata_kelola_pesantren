@extends('template_backend.home')
@section('heading', 'Data Nilai')
@section('page')
  <li class="breadcrumb-item active">Data Nilai</li>
@endsection
@section('content')
@php
    $no = 1;
@endphp
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Kode Mapel</th>
                <th rowspan="2">Ustadz/Ustadzah Mata Pelajaran</th>
                <th rowspan="2">KKM</th>
                <th colspan="4" class="text-center">Predikat</th>
              </tr>
              <tr>
                <th class="ctr">A</th>
                <th class="ctr">B</th>
                <th class="ctr">C</th>
                <th class="ctr">D</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($ustadz as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->kode }}</td>
                  <td>
                      <h5 class="card-title">{{ $data->mapel->nama_mapel }}</h5>
                      <p class="card-text"><small class="text-muted">{{ $data->nama_ustadz }} {{ $data->id }} {{ $data->mapel->kelompok }} {{ $data->nilai->kkm }}</small></p>
                  </td>
                  @foreach ($nilai as $datas)
                    @if ($data->id == $datas->ustadz_id)
                      <td>{{ $datas->kkm }}</td>
                      <td>{{ $datas->deskripsi_a }}</td>
                      <td>{{ $datas->deskripsi_b }}</td>
                      <td>{{ $datas->deskripsi_c }}</td>
                      <td>{{ $datas->deskripsi_d }}</td>
                    @endif
                  @endforeach
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
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Deskripsi").addClass("active");
    </script>
@endsection