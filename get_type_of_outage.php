<?php
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;*/
include('db/conn.php');
$data = [];
$data['message'] = '';
//echo json_encode($data);
if(empty($_POST['cid'])){
	$data['message'] = 'Something went wrong here...';
}
else {
	$get_description_outage = mysqli_query($db, "SELECT * FROM type_of_outage_description WHERE too_id='$_POST[cid]'");
	if($get_description_outage){
		while($rows = mysqli_fetch_assoc($get_description_outage)){
			$data['message'] = $data['message']. "<option value='$rows[id]'>$rows[description]</option>";
		}
	}
	else {
		$data['message'] = 'ERROR 401: Something Wrong with the Type of Outage Description';
	}
	//
}
echo json_encode($data);
?>