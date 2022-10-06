<?php
$mysqli = new mysqli("localhost","root","","sitkepam");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$id = $_REQUEST['id'];
echo $id;
if($res = $mysqli->query("SELECT a.*, s.*, k.* 
																FROM `absensi_santri` a
																inner join santri s on s.no_induk = a.santri_id 
																inner join kehadiran k on k.id = a.kehadiran_id
																WHERE a.santri_id = $id
																ORDER BY a.created_at DESC ")){
										while ($data1=$res->fetch_row()){
											echo $data1['4'];
										}
									}
?>