@extends('template_backend.home')
@section('heading', 'Entry Nilai Sikap')
@section('page')
  <li class="breadcrumb-item active">Entry Nilai Sikap</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Entry Nilai Sikap</h3>
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
                            <th rowspan="2" class="ctr">No.</th>
                            <th rowspan="2">Nama Santri</th>
                            <th colspan="3" class="ctr">Nilai Sikap<br>1 = Kurang | 2 = Cukup | 3 = Baik | 4 = Sangat Baik</th>
                            <th rowspan="2" class="ctr">Aksi</th>
                        </tr>
                        <tr>
                            <th class="ctr">Teman</th>
                            <th class="ctr">Sendiri</th>
                            <th class="ctr">Ustadz/Ustadzah</th>
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
                                        @if ($data->sikap($data->id) && $data->sikap($data->id)['id'])
                                            <input type="hidden" name="sikap_id" class="sikap_id_{{$data->id}}" value="{{ $data->sikap($data->id)['id'] }}">
                                        @else
                                            <input type="hidden" name="sikap_id" class="sikap_id_{{$data->id}}" value="">
                                        @endif
                                    </td>
                                    @if ($data->sikap($data->id) && $data->sikap($data->id)['sikap_1'])
                                        <td class="ctr">
                                            <div class="text-center">{{ $data->sikap($data->id)['sikap_1'] }}</div>
                                            <input type="text" name="sikap_1" onkeypress="return inputAngka(event)" style="margin: auto;" class="nilai form-control text-center sikap_1_{{$data->id}}" value="{{ $data->sikap($data->id)['sikap_1'] }}">
                                        </td>
                                    @else
                                        <td class="ctr"><input type="text" name="sikap_1" maxlength="1" onkeypress="return sikap(event)" style="margin: auto;" class="form-control text-center sikap_1_{{$data->id}}" autocomplete="off" autofocus></td>
                                    @endif
                                    @if ($data->sikap($data->id) && $data->sikap($data->id)['sikap_2'])
                                        <td class="ctr">
                                            <div class="text-center">{{ $data->sikap($data->id)['sikap_2'] }}</div>
                                            <input type="text" name="sikap_2" onkeypress="return inputAngka(event)" style="margin: auto;" class="nilai form-control text-center sikap_2_{{$data->id}}" value="{{ $data->sikap($data->id)['sikap_2'] }}">
                                        </td>
                                    @else
                                        <td class="ctr"><input type="text" name="sikap_2" maxlength="1" onkeypress="return sikap(event)" style="margin: auto;" class="form-control text-center sikap_2_{{$data->id}}" autocomplete="off" autofocus></td>
                                    @endif
                                    @if ($data->sikap($data->id) && $data->sikap($data->id)['sikap_3'])
                                        <td class="ctr">
                                            <div class="text-center">{{ $data->sikap($data->id)['sikap_3'] }}</div>
                                            <input type="text" name="sikap_3" onkeypress="return inputAngka(event)" style="margin: auto;" class="nilai form-control text-center sikap_3_{{$data->id}}" value="{{ $data->sikap($data->id)['sikap_3'] }}">
                                        </td>
                                    @else
                                        <td class="ctr"><input type="text" name="sikap_3" maxlength="1" onkeypress="return sikap(event)" style="margin: auto;" class="form-control text-center sikap_3_{{$data->id}}" autocomplete="off" autofocus></td>
                                    @endif
                                    @if ($data->sikap($data->id) && $data->sikap($data->id)['sikap_1'] && $data->sikap($data->id)['sikap_2'] && $data->sikap($data->id)['sikap_3'])
                                        <td class="ctr sub_{{$data->id}}">
                                            <!--<i class="fas fa-check" style="font-weight:bold;"></i>-->

                                            <form action="{{ route('sikap.destroy', $data->sikap($data->id)) }}" method="post">
                                                
                                                <button type="button" id="edit-{{$data->id}}" class="btn btn-default btn_edit" data-id="{{$data->id}}"><i class="text-primary nav-icon fas fa-edit"></i></button>

                                                <button type="button" id="batal-{{$data->id}}" class="btn btn-default btn_batal" data-id="{{$data->id}}"><i class="text-warning nav-icon fas fa-window-close"></i></button>

                                                <button type="button" id="submit-{{$data->id}}" class="btn btn-default btn_simpan" data-id="{{$data->id}}"><i class="nav-icon fas fa-save"></i></button>&nbsp;
                                                @csrf
                                                @method('delete')
                                                <button id="hapus-{{$data->id}}" class="btn btn-danger btn-sm" data-id="{{$data->id}}"><i class="nav-icon fas fa-trash-alt"></i></button>
                                            </form>

                                        </td>
                                    @else
                                        <td class="ctr sub_{{$data->id}}"><button type="button" id="submit-{{$data->id}}" class="btn btn-default btn_click" data-id="{{$data->id}}"><i class="nav-icon fas fa-save"></i></button></td>
                                    @endif
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
           var sikap_1 = $(".sikap_1_"+id);
           var sikap_2 = $(".sikap_2_"+id);
           var sikap_3 = $(".sikap_3_"+id);
           var simpan = $("#submit-"+id);
           var batal = $("#batal-"+id);
           var edit = $("#edit-"+id);
           var hapus = $("#hapus-"+id);
           sikap_1.show();
           sikap_2.show();
           sikap_3.show();
           simpan.show();
           batal.show();
           edit.hide();
           hapus.hide();
        });
        $(".btn_batal").click(function(){
           var id = $(this).attr('data-id');
           var sikap_1 = $(".sikap_1_"+id);
           var sikap_2 = $(".sikap_2_"+id);
           var sikap_3 = $(".sikap_3_"+id);
           var simpan = $("#submit-"+id);
           var batal = $("#batal-"+id);
           var edit = $("#edit-"+id);
           var hapus = $("#hapus-"+id);
           sikap_1.hide();
           sikap_2.hide();
           sikap_3.hide();
           simpan.hide();
           batal.hide();
           edit.show();
           hapus.show();
        });


        $(".btn_click").click(function(){
            var id = $(this).attr('data-id');
            var sikap_1 = $(".sikap_1_"+id).val();
            var sikap_2 = $(".sikap_2_"+id).val();
            var sikap_3 = $(".sikap_3_"+id).val();
            var sikap_id = $(".sikap_id_"+id).val();
            var ustadz_id = $("input[name=ustadz_id]").val();
            var kelas_id = $("input[name=kelas_id]").val();
            
            $.ajax({
                url: "{{ route('sikap.store') }}",
                type: "POST",
                dataType: 'json',
                data 	: {
                    _token: '{{ csrf_token() }}',
                    id : sikap_id,
                    santri_id : id,
                    kelas_id : kelas_id,
                    ustadz_id : ustadz_id,
                    sikap_1 : sikap_1,
                    sikap_2 : sikap_2,
                    sikap_3 : sikap_3
                },
                success: function(data){
                    toastr.success("Nilai sikap santri berhasil ditambahkan!");
                    location.reload();
                },
                error: function (data) {
                    toastr.warning("Errors 404!");
                }
            });
        });
        
        $("#NilaiUstadz").addClass("active");
        $("#liNilaiUstadz").addClass("menu-open");
        $("#SikapUstadz").addClass("active");
    </script>
@endsection