<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('db/conn.php');
//$_SESSION['gc_id'] = 1;
//$_SESSION['gf_id'] = 1;

session_start();
$data = [];
$combined_date_time = '';
if($_POST['too_'] != 0 && strlen($_POST['o_desc_']) != 0){
	$combined_date_time = $_POST['date_of_occ_'].' '.$_POST['time_of_occ_'].':00';
	$query2 = mysqli_query($db,"INSERT INTO outage_event(gc_id,gf_id,unit_id,total_outage,date_occ,time_occ,reason,too,too_description,outage_class,is_completed)
    VALUES('$_SESSION[gc_id]','$_SESSION[gf_id]','$_POST[own_unit_]','$_POST[total_outage_]','$combined_date_time','$_POST[time_of_occ_]','$_POST[reason_]','$_POST[too_]','$_POST[o_desc_]','$_POST[outage_class_]','N')");
	if($query2){
   $data['message'] = 'SUCCESS';
	}
	else {
		$data['message'] = '<p class="alert alert-danger">Error 404: Please Contact your Handsome Developer.</p>';

	}
	//$data['message'] = '<p class="alert alert-success">'.$_POST['rank_'].' '.$_POST['fullname_'].' Successfully Added</p>'; 
}
else {
	$data['message'] = '<p class="alert alert-danger">Type of Outage or Description Must be The Error.</p>';
}
echo json_encode($data);
?>