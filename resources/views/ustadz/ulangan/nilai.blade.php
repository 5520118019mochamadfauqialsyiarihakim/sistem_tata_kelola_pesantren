@extends('template_backend.home')
@section('heading', 'Entry Nilai Ulangan')
@section('page')
  <li class="breadcrumb-item active">Entry Nilai Ulangan</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Entry Nilai Ulangan</h3>
      </div>
      <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <table class="table" style="margin-top: -10px;">
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
                    <tr>
                        <td>Jumlah Santri</td>
                        <td>:</td>
                        <td>{{ $santri->count() }}</td>
                    </tr>
                    <tr>
                        <td>Mata Pelajaran</td>
                        <td>:</td>
                        <td>{{ $ustadz->mapel->nama_mapel }}</td>
                    </tr>
                    <tr>
                        <td>Ustadz/Ustadzah Mata Pelajaran</td>
                        <td>:</td>
                        <td>{{ $ustadz->nama_ustadz }}</td>
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
                            <th class="ctr">No.</th>
                            <th>Nama Santri</th>
                            <th class="ctr">ULHA 1</th>
                            <th class="ctr">ULHA 2</th>
                            <th class="ctr">UTS</th>
                            <th class="ctr">ULHA 3</th>
                            <th class="ctr">UAS</th>
                            <th class="ctr">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="ustadz_id" value="{{$ustadz->id}}">
                            <input type="hidden" name="kelas_id" value="{{$kelas->id}}">
                            @foreach ($santri as $data)
                                <input type="hidden" name="santri_id" value="{{$data->id}}">
                                <tr>
                                    <td class="ctr">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $data->nama_santri }}
                                        @if ($data->ulangan($data->id) && $data->ulangan($data->id)['id'])
                                            <input type="hidden" name="ulangan_id" class="ulangan_id_{{$data->id}}" value="{{ $data->ulangan($data->id)->id }}">
                                        @else
                                            <input type="hidden" name="ulangan_id" class="ulangan_id_{{$data->id}}" value="">
                                        @endif
                                    </td>
                                    <td class="ctr">
                                        @if ($data->ulangan($data->id) && $data->ulangan($data->id)['ulha_1'])
                                            <div class="text-center nilainya">{{ $data->ulangan($data->id)['ulha_1'] }}</div>
                                            <input type="text" name="ulha_1" onkeypress="return inputAngka(event)" style="margin: auto;" class="nilai form-control text-center ulha_1_{{$data->id}}" value="{{ $data->ulangan($data->id)['ulha_1'] }}">
                                        @else
                                            <input type="text" name="ulha_1" maxlength="3" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center ulha_1_{{$data->id}}" autocomplete="off">
                                        @endif
                                    </td>
                                    <td class="ctr">
                                        @if ($data->ulangan($data->id) && $data->ulangan($data->id)['ulha_2'])
                                            <div class="text-center nilainya">{{ $data->ulangan($data->id)['ulha_2'] }}</div>
                                            <input type="text" name="ulha_2" onkeypress="return inputAngka(event)" style="margin: auto;" class="nilai form-control text-center ulha_2_{{$data->id}}" value="{{ $data->ulangan($data->id)['ulha_2'] }}">
                                        @else
                                            <input type="text" name="ulha_2" maxlength="3" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center ulha_2_{{$data->id}}" autocomplete="off">
                                        @endif
                                    </td>
                                    <td class="ctr">
                                        @if ($data->ulangan($data->id) && $data->ulangan($data->id)['uts'])
                                            <div class="text-center nilainya">{{ $data->ulangan($data->id)['uts'] }}</div>
                                            <input type="text" name="uts" onkeypress="return inputAngka(event)" style="margin: auto;" class="nilai form-control text-center uts_{{$data->id}}" value="{{ $data->ulangan($data->id)['uts'] }}">
                                        @else
                                            <input type="text" name="uts" maxlength="3" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center uts_{{$data->id}}" autocomplete="off">
                                        @endif
                                    </td>
                                    <td class="ctr">
                                        @if ($data->ulangan($data->id) && $data->ulangan($data->id)['ulha_3'])
                                            <div class="text-center nilainya">{{ $data->ulangan($data->id)['ulha_3'] }}</div>
                                            <input type="text" name="ulha_3" onkeypress="return inputAngka(event)" style="margin: auto;"  class="nilai form-control text-center ulha_3_{{$data->id}}" value="{{ $data->ulangan($data->id)['ulha_3'] }}">
                                        @else
                                            <input type="text" name="ulha_3" maxlength="3" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center ulha_3_{{$data->id}}" autocomplete="off">
                                        @endif
                                    </td>
                                    <td class="ctr">
                                        @if ($data->ulangan($data->id) && $data->ulangan($data->id)['uas'])
                                            <div class="text-center nilainya">{{ $data->ulangan($data->id)['uas'] }}</div>
                                            <input type="text" name="uas" onkeypress="return inputAngka(event)" style="margin: auto;"  class="nilai form-control text-center uas_{{$data->id}}" value="{{ $data->ulangan($data->id)['uas'] }}">
                                        @else
                                            <input type="text" name="uas" maxlength="3" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center uas_{{$data->id}}" autocomplete="off">
                                        @endif
                                    </td>
                                    <td class="ctr sub_{{$data->id}}">
                                        @if ($data->ulangan($data->id))

                                            <form action="{{ route('ulangan.destroy', $data->ulangan($data->id)) }}" method="post">
                                            <!--<i class="fas fa-check" style="font-weight:bold;"></i>&nbsp;-->
                                            <button type="button" id="edit-{{$data->id}}" class="btn btn-default btn_edit" data-id="{{$data->id}}"><i class="text-primary nav-icon fas fa-edit"></i></button>

                                            <button type="button" id="batal-{{$data->id}}" class="btn btn-default btn_batal" data-id="{{$data->id}}"><i class="text-warning nav-icon fas fa-window-close"></i></button>

                                            <button type="button" id="submit-{{$data->id}}" class="btn btn-default btn_simpan" data-id="{{$data->id}}"><i class="nav-icon fas fa-save"></i></button>&nbsp;
                                                @csrf
                                                @method('delete')
                                                <button id="hapus-{{$data->id}}" class="btn btn-danger btn-sm" data-id="{{$data->id}}"><i class="nav-icon fas fa-trash-alt"></i></button>
                                            </form>
                                        @else
                                            <button type="button" id="submit-{{$data->id}}" class="btn btn-default btn_click" data-id="{{$data->id}}"><i class="nav-icon fas fa-save"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </form>
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
        function buka() {
            $(".nilai").hide();
            $(".btn_simpan").hide();
            $(".btn_batal").hide();
        }
        window.onload = buka;
        $(".btn_edit").click(function(){
           var id = $(this).attr('data-id');
           var ulha_1 = $(".ulha_1_"+id);
           var ulha_2 = $(".ulha_2_"+id);
           var uts = $(".uts_"+id);
           var ulha_3 = $(".ulha_3_"+id);
           var uas = $(".uas_"+id);
           var simpan = $("#submit-"+id);
           var batal = $("#batal-"+id);
           var edit = $("#edit-"+id);
           var hapus = $("#hapus-"+id);
           ulha_1.show();
           ulha_2.show();
           ulha_3.show();
           uts.show();
           uas.show();
           simpan.show();
           batal.show();
           edit.hide();
           hapus.hide();
        });
        $(".btn_batal").click(function(){
           var id = $(this).attr('data-id');
           var ulha_1 = $(".ulha_1_"+id);
           var ulha_2 = $(".ulha_2_"+id);
           var uts = $(".uts_"+id);
           var ulha_3 = $(".ulha_3_"+id);
           var uas = $(".uas_"+id);
           var simpan = $("#submit-"+id);
           var batal = $("#batal-"+id);
           var edit = $("#edit-"+id);
           var hapus = $("#hapus-"+id);
           ulha_1.hide();
           ulha_2.hide();
           ulha_3.hide();
           uts.hide();
           uas.hide();
           simpan.hide();
           batal.hide();
           edit.show();
           hapus.show();
        });

        $(".btn_click").click(function(){
            var id = $(this).attr('data-id');
            var ulha_1 = $(".ulha_1_"+id).val();
            var ulha_2 = $(".ulha_2_"+id).val();
            var uts = $(".uts_"+id).val();
            var ulha_3 = $(".ulha_3_"+id).val();
            var uas = $(".uas_"+id).val();
            var ulangan_id = $(".ulangan_id_"+id).val();
            var ustadz_id = $("input[name=ustadz_id]").val();
            var kelas_id = $("input[name=kelas_id]").val();
            
            $.ajax({
                url: "{{ route('ulangan.store') }}",
                type: "POST",
                dataType: 'json',
                data 	: {
                    _token: '{{ csrf_token() }}',
                    id : ulangan_id,
                    santri_id : id,
                    kelas_id : kelas_id,
                    ustadz_id : ustadz_id,
                    ulha_1 : ulha_1,
                    ulha_2 : ulha_2,
                    uts : uts,
                    ulha_3 : ulha_3,
                    uas : uas,
                },
                success: function(data){
                    toastr.success("Nilai ulangan santri berhasil ditambahkan!");
                    location.reload();
                },
                error: function (data) {
                    toastr.warning("Errors! Silahkan Cek Predikat Matpel Anda dan Cek KKM Anda");
                }
            });
        });

        $(".btn_simpan").click(function(){
            var id = $(this).attr('data-id');
            var ulha_1 = $(".ulha_1_"+id).val();
            var ulha_2 = $(".ulha_2_"+id).val();
            var uts = $(".uts_"+id).val();
            var ulha_3 = $(".ulha_3_"+id).val();
            var uas = $(".uas_"+id).val();
            var ulangan_id = $(".ulangan_id_"+id).val();
            var ustadz_id = $("input[name=ustadz_id]").val();
            var kelas_id = $("input[name=kelas_id]").val();
            
            $.ajax({
                url: "{{ route('ulangan.store') }}",
                type: "POST",
                dataType: 'json',
                data    : {
                    _token: '{{ csrf_token() }}',
                    id : ulangan_id,
                    santri_id : id,
                    kelas_id : kelas_id,
                    ustadz_id : ustadz_id,
                    ulha_1 : ulha_1,
                    ulha_2 : ulha_2,
                    uts : uts,
                    ulha_3 : ulha_3,
                    uas : uas,
                },
                success: function(data){
                    toastr.success("Nilai ulangan santri berhasil diedit!");
                    location.reload();
                },
                error: function (data) {
                    toastr.warning("Errors! Silahkan Cek Predikat Matpel Anda dan Cek KKM Anda");
                }
            });
        });
        
        $("#NilaiUstadz").addClass("active");
        $("#liNilaiUstadz").addClass("menu-open");
        $("#UlanganUstadz").addClass("active");
    </script>
@endsection