@extends('template_backend.home')
@section('heading', 'Kamar Santri')
@section('page')
  <li class="breadcrumb-item active">Kamar Santri</li>
@endsection
@section('content')

    	 <iframe width="100%" class="col-md-12" height="600" src="http://localhost/sitkepam/kamarsantri.php" frameBorder="0"></iframe> 

@endsection
@section('script')
    <script>
        $("#Kamar").addClass("active");
    </script>
@endsection