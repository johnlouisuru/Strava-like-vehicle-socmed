<?php  
 date_default_timezone_set('Asia/Manila');
 //echo facebook_time_ago('2023-01-13 06:04:15');  
 function ilang_oras_na($date1,$date2)  
 {  
      $date_1 = date("d-M-Y H:i", strtotime($date1));
      $date_2 = date("d-M-Y H:i", strtotime($date2));
      $time_ago = strtotime($date_1);  
                      $current_time = strtotime($date_2);  
                      $time_difference = $current_time - $time_ago;  
                      $seconds = $time_difference;  
                      $minutes = ($seconds / 60 );           // value 60 is seconds  
                      $hours   = round($seconds / 3600, 3);           //value 3600 is 60 minutes * 60 sec  
     return $hours;
}  
function date_format_natin($date1)  
 {   
     return date("d-M-Y H:i", strtotime($date1));
}
function bawal_overlapping($doc, $toc, $sql){
      $loop = 0;
      if(mysqli_num_rows($sql) >= 1){
          while($if_completed = mysqli_fetch_assoc($sql)){
            //$resumed_date = date("Y-m-d", strtotime($if_completed['date_res']));
            $outage_date_res = date("Y-m-d", strtotime($if_completed['date_res']));
            $outage_date_req = date("Y-m-d", strtotime($_POST['date_of_occ_']));
            //$outage_time_res = $if_completed['time_res'];
            $outage_time_res = str_replace(array(':'), '', $if_completed['time_res']);
            $outage_time_req = str_replace(array(':'), '', $_POST['time_of_occ_']);
            
            if($outage_date_res == $outage_date_req){
              if($outage_time_req <= $outage_time_res){
                  $loop++;
              }
              
            }
            else {
            }
          }
        }
        if($loop >= 1){
            return 1;
        }
        else {
            return 0;
        }
}

function bawal_overlapping_2($doc, $toc, $sql){
      $loop = 0;
      if(mysqli_num_rows($sql) >= 1){
          while($if_completed = mysqli_fetch_assoc($sql)){
            //$resumed_date = date("Y-m-d", strtotime($if_completed['date_res']));
            $outage_date_res = date("Y-m-d", strtotime($if_completed['date_res']));
            $outage_date_occ = date("Y-m-d", strtotime($if_completed['date_occ']));
            $outage_date_req = date("Y-m-d", strtotime($_POST['date_of_occ_']));
            //$outage_time_res = $if_completed['time_res'];
            $outage_time_res = str_replace(array(':'), '', $if_completed['time_res']);
            $outage_time_occ = str_replace(array(':'), '', $if_completed['time_occ']);
            $outage_time_req = str_replace(array(':'), '', $_POST['time_of_occ_']);
            
            
            if($outage_date_res > $outage_date_req && $outage_date_occ < $outage_date_req){
                  $loop++;
            }
            else if($outage_date_res == $outage_date_req){
              if($outage_time_req <= $outage_time_res){
                  $loop++;
              }
              
            }
            else {
            }
          }
        }
        if($loop >= 1){
            return 1;
        }
        else {
            return 0;
        }
}

function bawal_overlapping_resumption($doc, $toc, $sql){
      $loop = 0;
      if(mysqli_num_rows($sql) >= 1){
          while($if_completed = mysqli_fetch_assoc($sql)){
            //$resumed_date = date("Y-m-d", strtotime($if_completed['date_res']));
            //$outage_date_res = date("Y-m-d", strtotime($if_completed['date_res']));
            $outage_date_occ = date("Y-m-d", strtotime($if_completed['date_occ']));
            $outage_date_req = date("Y-m-d", strtotime($doc));
            //$outage_time_res = $if_completed['time_res'];
            $outage_time_res = str_replace(array(':'), '', $if_completed['time_res']);
            $outage_time_occ = str_replace(array(':'), '', $if_completed['time_occ']);
            $outage_time_req = str_replace(array(':'), '', $toc);
            
            
            if($outage_date_req < $outage_date_occ){
                  $loop++;
            }
            else if($outage_date_req == $outage_date_occ){
              if($outage_time_req <= $outage_time_occ){
                  $loop++;
              }
              
            }
            else {
            }
          }
        }
        if($loop >= 1){
            return 1;
        }
        else {
            return 0;
        }
}

function planned_ten_days($doc){
           /* $outage_date_req = date_create($doc);
            $date_today = date("Y-m-d");
            $diff=date_diff($date_today,$outage_date_req);
            $days = $diff->format("%a");
            return $days;*/


            $now = time(); // or your date as well
            $outage_date_req = strtotime($doc);
            $datediff = $outage_date_req - $now;

            return round($datediff / (60 * 60 * 24));
}
 
 ?>