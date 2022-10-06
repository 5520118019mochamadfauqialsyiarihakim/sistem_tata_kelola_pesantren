@extends('template_backend.home')
@section('heading', 'Nilai Sikap')
@section('page')
  <li class="breadcrumb-item active">Nilai Sikap</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Nilai Sikap Santri</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td>No Induk Santri</td>
                        <td>:</td>
                        <td>{{ Auth::user()->no_induk }}</td>
                    </tr>
                    <tr>
                        <td>Nama Santri</td>
                        <td>:</td>
                        <td class="text-capitalize">{{ Auth::user()->name }}</td>
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
                            <th class="ctr">Ustadz</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $s1 = 0;
                            $s2 = 0;
                            $s3 = 0;
                            $no = 0;
                        @endphp
                        @foreach ($mapel as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_mapel }}</td>
                                <td class="ctr">
                                    {{ $data->sikap($data->id)['sikap_1'] ?? 'Belum Ada Nilai' }}
                                    @php $ss1 = $data->sikap($data->id)['sikap_1'] ?? "0" @endphp
                                </td>
                                <td class="ctr">
                                    {{ $data->sikap($data->id)['sikap_2'] ?? 'Belum Ada Nilai' }}
                                    @php $ss2 = $data->sikap($data->id)['sikap_2'] ?? "0" @endphp
                                </td>
                                <td class="ctr">
                                    {{ $data->sikap($data->id)['sikap_3'] ?? 'Belum Ada Nilai' }}
                                    @php $ss3 = $data->sikap($data->id)['sikap_3'] ?? "0" @endphp
                                </td>
                            </tr>
                        @php                            
                            $s1 = $s1+$ss1;            
                            $s2 = $s2+$ss2;            
                            $s3 = $s3+$ss3;
                            $no++;
                        @endphp
                        @endforeach
                        <tr>
                            <td colspan="2" class="ctr">Jumlah</td>
                            <td class="ctr">{{ $s1 }}</td>
                            <td class="ctr">{{ $s2 }}</td>
                            <td class="ctr">{{ $s3 }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="ctr">Rata-rata Sikap</td>
                            <td class="ctr">{{ $rata1 = $s1/$no }}</td>
                            <td class="ctr">{{ $rata2 = $s2/$no }}</td>
                            <td class="ctr">{{ $rata3 = $s3/$no }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="ctr">Pembulatan & Nilai Sikap</td>
                            <td class="ctr">
                                {{ $nilai1 = ceil($rata1 = $s1/$no) }}<br>(
                                @if ($nilai1 == 4)
                                    <b>Sangat Baik</b>
                                @elseif ($nilai1 == 3)
                                    <b>Baik</b>
                                @elseif ($nilai1 == 2)
                                    <b>Cukup</b>
                                @else
                                    <b>Kurang</b>
                                @endif )
                            </td>
                            <td class="ctr">{{ $nilai2 = ceil($rata2 = $s2/$no) }}<br>(
                                @if ($nilai2 == 4)
                                    <b>Sangat Baik</b>
                                @elseif ($nilai2 == 3)
                                    <b>Baik</b>
                                @elseif ($nilai2 == 2)
                                    <b>Cukup</b>
                                @else
                                    <b>Kurang</b>
                                @endif )</td>
                            <td class="ctr">{{ $nilai3 = ceil($rata3 = $s3/$no) }}<br>(
                                @if ($nilai3 == 4)
                                    <b>Sangat Baik</b>
                                @elseif ($nilai3 == 3)
                                    <b>Baik</b>
                                @elseif ($nilai3 == 2)
                                    <b>Cukup</b>
                                @else
                                    <b>Kurang</b>
                                @endif )</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="ctr">Nilai Akhir Sikap</td>
                            <td colspan="3" class="ctr">@php $tot=$nilai1+$nilai2+$nilai3; $t=ceil($tot/3); @endphp {{ $tot }} = {{ $t }}<br>(
                                @if ($t == 4)
                                    <b>Sangat Baik</b>
                                @elseif ($t == 3)
                                    <b>Baik</b>
                                @elseif ($t == 2)
                                    <b>Cukup</b>
                                @else
                                    <b>Kurang</b>
                                @endif )</td>
                        </tr>
                    </tfoot>
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
        $("#SikapSantri").addClass("active");
    </script>
@endsection