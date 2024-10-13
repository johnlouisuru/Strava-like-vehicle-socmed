<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('db/conn.php');
//$_SESSION['gc_id'] = 1;
//$_SESSION['gf_id'] = 1;

session_start();
$data = [];
$combined_date_time = '';
$is_completed = "Y";
if($_SESSION['gf_id'] != 0 && $_SESSION['gc_id'] != 0){
	$combined_date_time = $_POST['date_of_res_'].' '.$_POST['time_of_res_'].':00';
	$update_event = mysqli_query($db,"UPDATE outage_event SET date_res='".$combined_date_time."', time_res='".$_POST['time_of_res_']."', is_completed ='".$is_completed."' WHERE gf_id='".$_SESSION['gf_id']."' AND gc_id='".$_SESSION['gc_id']."' AND unit_id='".$_POST['unit_id_']."'");

	if($update_event){
   $data['message'] = 'SUCCESS';
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