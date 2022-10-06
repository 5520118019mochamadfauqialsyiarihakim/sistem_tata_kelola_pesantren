@extends('template_backend.home')
@section('heading', 'Absen Harian Santri')
@section('page')
  <li class="breadcrumb-item active">Absen Harian Santri</li>
@endsection
@section('content')
@php
    $no = 1;
@endphp
	@if (Auth::user()->role == 'Admin')
          <iframe width="100%" class="col-md-12" height="600" src="http://localhost/sitkepam/absensantris.php?id={{ Auth::user()->no_induk }}" frameBorder="0"></iframe>
    @else
    	 <iframe width="100%" class="col-md-12" height="600" src="http://localhost/sitkepam/absensantri.php?id={{ Auth::user()->no_induk }}" frameBorder="0"></iframe> 
    @endif

@endsection
@section('script')
    <script>
        $("#AbsenSantri").addClass("active");
    </script>
@endsection