<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('db/conn.php');
require('all_about_date_and_time.php');
//$_SESSION['gc_id'] = 1;
//$_SESSION['gf_id'] = 1;

//session_start();
$data = [];
$combined_date_time = '';
$is_completed = "Y";

//Check kung yung unit ay Under Outage sa Range ng date na ilalagay as Date of Occurrence
  $check_outage_overlap = mysqli_query($db, "SELECT * FROM outage_event WHERE unit_id = '$_POST[unit_id_]' AND gf_id='$_SESSION[gf_id]' AND is_completed='N'");
  if(bawal_overlapping_resumption($_POST['date_of_res_'],$_POST['time_of_res_'],$check_outage_overlap) == 1){
  	$data['message'] = "Unit Resumption is in earlier than Occurrence Event: Overlapping is Invalid.";
	echo json_encode($data);
	die();
  }
  else {

  }
if($_SESSION['gf_id'] != 0 && $_SESSION['gc_id'] != 0){
	$combined_date_time = $_POST['date_of_res_'].' '.$_POST['time_of_res_'].':00';
	$update_event = mysqli_query($db,"UPDATE outage_event SET date_res='".$combined_date_time."', time_res='".$_POST['time_of_res_']."', is_completed ='".$is_completed."' WHERE gf_id='".$_SESSION['gf_id']."' AND gc_id='".$_SESSION['gc_id']."' AND unit_id='".$_POST['unit_id_']."'");

	$query_logs = mysqli_query($db,"INSERT INTO logs(gc_id,gf_id,unit_id,activity,date_res)
    	VALUE('$_SESSION[gc_id]','$_SESSION[gf_id]','$_POST[unit_id_]','Resumed Outage Event','$combined_date_time')");
	if($update_event){
   		$data['message'] = 'SUCCESS';
   		if($query_logs){
   			$data['message'] = 'SUCCESS';
   		}
   		else {
   			$data['message'] = 'SUCCESS without logs';
   		}
	}
	else {
		//$data['message'] = '<p class="alert alert-danger">Error 404: Please Contact your Handsome Developer.</p>';
		$data['message'] = $update_event;

	}
	//$data['message'] = '<p class="alert alert-success">'.$_POST['rank_'].' '.$_POST['fullname_'].' Successfully Added</p>'; 
}
else {
	$data['message'] = '<p class="alert alert-danger">Error 404:</p>';
}
echo json_encode($data);
?>