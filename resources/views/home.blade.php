@extends('template_backend.home')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="col-md-12" id="load_content">
      <div class="card card-primary">
        <div class="card-body">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th colspan="4"><h4 align="center">Jadwal Mata Pelajaran Hari Ini</h4></th>
                  </tr>
                  <tr>
                    <th>Jam Pelajaran</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Ruang Kelas</th>
                  </tr>
                </thead>
                <tbody id="data-jadwal">
                    @php
                      $hari = date('w');
                      $jam = date('H:i');
                    @endphp
                    @foreach ($jadwal as $data)
                    @if ( $hari == $data->hari_id )
                      <tr>
                        <td>{{ $data->jam_mulai.' - '.$data->jam_selesai }}</td>
                        <td>
                            <h5 class="card-title">{{ $data->mapel->nama_mapel }}</h5>
                            <p class="card-text"><small class="text-muted">{{ $data->ustadz->nama_ustadz }}</small></p>
                        </td>
                        <td>{{ $data->kelas->nama_kelas }}</td>
                        <td>{{ $data->ruang->nama_ruang }}</td>
                      </tr>
                    @endif
                    @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card card-warning" style="min-height: 385px;">
        <div class="card-header">
          <h3 class="card-title" style="color: white;">
            Pengumuman
          </h3>
        </div>
        <div class="card-body">
          <div class="tab-content p-0">
            {!! $pengumuman->isi !!}
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            Keterangan :
          </h3>
        </div>
        <div class="card-body">
          <div class="tab-content p-0">
            <table class="table" style="margin-top: -21px; margin-bottom: -10px;">
              @foreach ($kehadiran as $data)
                <tr>
                  <td>
                    <div style="width:30px;height:30px;background:#{{ $data->color }}"></div>
                  </td>
                  <td>:</td>
                  <td>{{ $data->ket }}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
    <script>
      $(document).ready(function () {
        setInterval(function() {
          var date = new Date();
          var hari = date.getDay();
          var h = date.getHours();
          var m = date.getMinutes();
          h = (h < 10) ? "0" + h : h;
          m = (m < 10) ? "0" + m : m;
          var jam = h + ":" + m;
          
                $.ajax({
                  type:"GET",
                  data: {
                    hari : hari,
                    jam : jam
                  },
                  dataType:"JSON",
                  url:"{{ url('/jadwal/sekarang') }}",
                  success:function(data){
                    var html = "";
                    $.each(data, function (index, val) {
                        html += "<tr>";
                          html += "<td>" + val.jam_mulai + ' - ' + val.jam_selesai + "</td>";
                          html += "<td><h5 class='card-title'>" + val.mapel + "</h5><p class='card-text'><small class='text-muted'>" + val.ustadz + "</small></p></td>";
                          html += "<td>" + val.kelas + "</td>";
                          html += "<td>" + val.ruang + "</td>";
                          if (val.ket != null) {
                            html += "<td><div style='margin-left:20px;width:30px;height:30px;background:#"+val.ket+"'></div></td>";
                          } else {
                            html += "<td></td>";
                          }
                        html += "</tr>";
                    });
                    $("#data-jadwal").html(html);
                  },
                  error:function(){
                  }
                });
              
            
          
        }, 60 * 1000);
      });
      
      $("#Dashboard").addClass("active");
      $("#liDashboard").addClass("menu-open");
      $("#Home").addClass("active");
    </script>
@endsection
