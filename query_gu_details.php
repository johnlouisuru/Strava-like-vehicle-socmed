<?php
date_default_timezone_set('Asia/Manila');
 function ilang_outages_na($get_if_q_valid, $flag)  
 {  
    $total_hours_holder = 0;
                  $number_of_outages = 0;
                  $tempo_hour_holder = 0;
                  $dates_of_outage = '';
                  $time_each_date = 0;
      if(mysqli_num_rows($count_all_outages) >= 1){
        while($rows2 = mysqli_fetch_assoc($count_all_outages)){
          $timestamp1 = strtotime($rows2['date_occ']);
          $timestamp2 = strtotime($rows2['date_res']);
          $time_each_date = round($hour = abs($timestamp2 - $timestamp1)/(60*60), 3);
          $dates_of_outage = $dates_of_outage . date("Y-M-d H:i", strtotime($rows2['date_occ'])).'H to ';
          $dates_of_outage = $dates_of_outage . date("Y-M-d H:i", strtotime($rows2['date_res'])).'H ['.$time_each_date.' hrs]<br>';
          $tempo_hour_holder = round($hour = abs($timestamp2 - $timestamp1)/(60*60), 3);
          $total_hours_holder = $total_hours_holder + $tempo_hour_holder;
          $number_of_outages++;
        }
      }
      return $flag;
}  
?>