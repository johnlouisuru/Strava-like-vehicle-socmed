

//Invalid
  $check_outage = mysqli_query($db, "SELECT * FROM outage_event WHERE unit_id = '$_POST[own_unit_]' AND gf_id='$_SESSION[gf_id]' AND is_completed='Y' AND MONTH(date_res) = MONTH($_POST[date_of_occ_]) AND DAY(date_res) = DAY($_POST[date_of_occ_])");
/// AND MONTH(date_res) = MONTH($_POST[date_of_occ_]) AND DAY(date_res) = DAY($_POST[date_of_occ_])
if(mysqli_num_rows($check_outage) >= 1){
  while($if_completed = mysqli_fetch_assoc($check_outage)){
    $outage_date_res = date("Y-m-d", strtotime($if_completed['date_res']));
    //$outage_time_res = $if_completed['time_res'];
    $outage_time_res = str_replace(array(':'), '', $if_completed['time_res']);
    
    if($outage_date_res == strtotime($_POST["date_of_occ_"]) && $_POST["time_of_occ_"] < $outage_time_res){
      $data['message'] = "Time Cannot be Overlay on the same Unit. $_POST[time_of_occ_] is ealier than Unit`s recent Resumption.";
      echo json_encode($data);
      die();
    }
  }
  $data['message'] = "This Unit already in Outage Event.";
  echo json_encode($data);
  die();
}
//Invalid