@extends('template_backend.home')
@section('heading', 'Show Nilai Sikap')
@section('page')
  <li class="breadcrumb-item active">Show Nilai Sikap</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Show Nilai Sikap</h3>
      </div>
      <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td>No Induk Santri</td>
                        <td>:</td>
                        <td>{{ $santri->no_induk }}</td>
                    </tr>
                    <tr>
                        <td>Nama Santri</td>
                        <td>:</td>
                        <td>{{ $santri->nama_santri }}</td>
                    </tr>
                    <tr>
                        <td>Nama Kelas</td>
                        <td>:</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <td>Wali Kelas</td>
                        <td>:</td>
                        <td>{{ $kelas->ustadz->nama_ustadz }}</td>
                    </tr>
                    @php
                        $bulan = date('m');
                        $tahun = date('Y');
                    @endphp
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>
                            @if ($bulan > 6)
                                {{ 'Semester Ganjil' }}
                            @else
                                {{ 'Semester Genap' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tahun Pelajaran</td>
                        <td>:</td>
                        <td>
                            @if ($bulan > 6)
                                {{ $tahun }}/{{ $tahun+1 }}
                            @else
                                {{ $tahun-1 }}/{{ $tahun }}
                            @endif
                        </td>
                    </tr>
                </table>
                <hr>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" class="ctr">No.</th>
                            <th rowspan="2">Nama Mata Pelajaran</th>
                            <th colspan="3" class="ctr">Nilai Sikap</th>
                        </tr>
                        <tr>
                            <th class="ctr">Teman</th>
                            <th class="ctr">Sendiri</th>
                            <th class="ctr">Ustadz/Ustadzah</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if($mapel != NULL)
                            @foreach ($mapel as  $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_mapel }}</td>
                                    @php
                                        $array = array('mapel' => $data->id, 'santri' => $santri->id);
                                        $jsonData = json_encode($array);
                                    @endphp
                                    <td class="ctr">{{ $data->cekSikap($jsonData)['sikap_1'] }}</td>
                                    <td class="ctr">{{ $data->cekSikap($jsonData)['sikap_2'] }}</td>
                                    <td class="ctr">{{ $data->cekSikap($jsonData)['sikap_3'] }}</td>
                                </tr>
                            @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Sikap").addClass("active");
    </script>
@endsection
