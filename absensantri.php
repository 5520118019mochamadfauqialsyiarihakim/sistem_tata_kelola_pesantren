<?php
	include("config/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sistem Informasi Tata Kelola Pengajaran Pesantren Al-Muthmainnah</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/summernote/summernote-bs4.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/toastr/toastr.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/fullcalendar/main.min.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/fullcalendar-daygrid/main.min.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/fullcalendar-timegrid/main.min.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/fullcalendar-bootstrap/main.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="shrotcut icon" href="http://127.0.0.1:8000/img/favicon.png">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <style>
        .ctr {
            text-align: center !important;
        }
        
        thead > tr > th, tbody > tr > td{
            vertical-align: middle !important;
        }

        td> input.form-control{
            width: 60px !important;
            padding: 8px !important;
            box-shadow: none !important;
        }

        input[name=predikat]{
            align-items: center;
            width:60px !important;
            background:#fff !important;
            box-shadow: none !important;
        }

        input[disabled],input[disabled]:hover{
            cursor: default !important;
            border:none !important;
        }
        
        .textarea-rapot{
            font-size:11px !important;
            background: #fff !important;
            border:none !important;
            font-size: 11px !important;
            cursor: default !important;
        }

        @media (min-width: 768px) {
            .img-details {
                margin-left: 40px;
            }
            .btn-details {
                margin-top: 28px !important;
            }
            .btn-details-santri {
                margin-top: 175px !important;
            }
        }
    </style>
</head>
<!-- sidebar-collapse -->
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-open">
<div class="wrapper">
<!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6"><br>
					    <div class="card">
					        <div class="card-body">
					          <table id="example1" class="table table-bordered table-striped table-hover">
					            <thead>
					                <tr>
					                    <th>No</th>
					                    <th>Nama Santri</th>
					                    <th>Ket.</th>
					                    <th>Waktu Absen</th>
					                </tr>
					            </thead>
					            <tbody>
					            	<?php
					            	
$mysqli = new mysqli("localhost","root","","sitkepam");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

					            		$no=1;
					              		if($res = $mysqli->query("SELECT a.*, s.*, k.* 
																FROM `absensi_santri` a
																inner join santri s on s.no_induk = a.santri_id 
																inner join kehadiran k on k.id = a.kehadiran_id
																WHERE a.santri_id = '$_REQUEST[id]' ORDER BY a.created_at DESC ")){
										while ($data1=$res->fetch_row()){
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $data1['2']."(".$data1['9'].")"; ?></td>
											<td><?php echo $data1['20']; ?></td>
											<td><?php echo $data1['4']; ?></td>
										</tr>
									<?php
										$no++;
										}
										}
									?>
					            </tbody>
					          </table>
					        </div>
					    </div>
					</div>
					<div class="col-md-6"><br>
					    <div class="card card-primary">
					      <div class="card-header">
					        <h3 class="card-title">Absen Harian Santri</h3>
					      </div>
					      <form action="" method="post">
				        	<?php
				        		if($res2 = $mysqli->query("SELECT a.*, s.*, k.* 
														FROM `absensi_santri` a
														inner join santri s on s.no_induk = a.santri_id 
														inner join kehadiran k on k.id = a.kehadiran_id
														ORDER BY a.created_at DESC ")){
				        			$jml = 0;
								while ($data2=$res2->fetch_row()){
									$jml++;
									if($data2['2']==$_REQUEST['id']){
										echo "<caption><span class='text-center'>Anda Sudah Absen Hari ini</span></caption>";
									}else{
				        	?>
					        <div class="card-body">
					            <div class="form-group">
					                <label for="nis">NIS</label>
					                <input type="text" id="niss" name="niss" onkeypress="return inputAngka(event)" class="form-control" readonly="" value="<?php if(isset($_REQUEST['niss']) OR isset($_REQUEST['id'])){ echo $_REQUEST['id']; } ?>">
					                <input type="hidden" id="nis" name="nis" onkeypress="return inputAngka(event)" class="form-control" readonly="" value="<?php echo $_REQUEST['id']; ?>">
					            </div>
					            <div class="form-group">
					              <label for="kehadiran_id">Keterangan Kehadiran</label>
					              <select id="kehadiran_id" type="text" class="form-control select2bs4" name="kehadiran_id" required="">
					                <option value="">-- Pilih Keterangan Kehadiran --</option>
					              	<?php
					              		if($result1 = $mysqli->query("SELECT * FROM `kehadiran`")){
										while ($data=$result1->fetch_row()){
									?>

					                <option value="<?php echo $data[0]; ?>"><?php echo $data[1]; ?></option>

									<?php
										}
										$result1 -> free_result();
										}

									?>	
					              </select>
					            </div>
					        </div>
					        <div class="card-footer">
					          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Absen</button>
					        </div>

					            <?php
					        		}
					        		}
					        		}
					        	?>
					      </form>
					    </div>
					</div>
				</div>	
			</div>
		</section>
</div>
</body>

<!-- jQuery -->
<script src="http://127.0.0.1:8000/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="http://127.0.0.1:8000/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="http://127.0.0.1:8000/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="http://127.0.0.1:8000/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="http://127.0.0.1:8000/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->


<!-- jQuery Knob Chart -->
<script src="http://127.0.0.1:8000/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="http://127.0.0.1:8000/plugins/moment/moment.min.js"></script>
<script src="http://127.0.0.1:8000/plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE App -->
<script src="http://127.0.0.1:8000/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="http://127.0.0.1:8000/dist/js/demo.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="http://127.0.0.1:8000/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="http://127.0.0.1:8000/plugins/summernote/summernote-bs4.min.js"></script>
<!-- SweetAlert2 -->
<script src="http://127.0.0.1:8000/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="http://127.0.0.1:8000/plugins/toastr/toastr.min.js"></script>
<!-- overlayScrollbars -->
<script src="http://127.0.0.1:8000/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Select2 -->
<script src="http://127.0.0.1:8000/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="http://127.0.0.1:8000/plugins/moment/moment.min.js"></script>
<script src="http://127.0.0.1:8000/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="http://127.0.0.1:8000/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- date-range-picker -->
<script src="http://127.0.0.1:8000/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="http://127.0.0.1:8000/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="http://127.0.0.1:8000/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="http://127.0.0.1:8000/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="http://127.0.0.1:8000/dist/js/pages/dashboard.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="http://127.0.0.1:8000/plugins/moment/moment.min.js"></script>
<script src="http://127.0.0.1:8000/plugins/fullcalendar/main.min.js"></script>
<script src="http://127.0.0.1:8000/plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="http://127.0.0.1:8000/plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="http://127.0.0.1:8000/plugins/fullcalendar-interaction/main.min.js"></script>
<script src="http://127.0.0.1:8000/plugins/fullcalendar-bootstrap/main.min.js"></script>
<!-- Ekko Lightbox -->
<script src="http://127.0.0.1:8000/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- DataTables -->
<script src="http://127.0.0.1:8000/plugins/datatables/jquery.dataTables.js"></script>
<script src="http://127.0.0.1:8000/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- bs-custom-file-input -->
<script src="http://127.0.0.1:8000/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- page script -->


</body>
</html>

<?php
	if(isset($_REQUEST['submit'])){
		$tanggal = date('Y-m-d');
		$santri_id = $_REQUEST['niss'];
		$kehadiran_id = $_REQUEST['kehadiran_id'];
		if($simp = $mysqli->query("INSERT INTO `absensi_santri` VALUES ('','$tanggal','$santri_id','$kehadiran_id',current_timestamp(),current_timestamp()) ")){
			echo "<script>alert('Absen Berhasil')</script>";
			echo "<meta http-equiv='refresh' content='0; url=http://localhost/sitkepam/absensantri.php?id=".$santri_id."'>";
		}else{
			echo "gagal absen";
		}
	}
?>