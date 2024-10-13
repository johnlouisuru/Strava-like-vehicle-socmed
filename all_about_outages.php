<?php
date_default_timezone_set('Asia/Manila');
 function ilang_outages_na($date1,$date2,$total_hours_holder,$number_of_outages,$tempo_hour_holder)  
 {  
  
    $timestamp1 = strtotime($date1);
    $timestamp2 = strtotime($date2);
    $time_each_date = round($hour = abs($timestamp2 - $timestamp1)/(60*60), 3);
    //$dates_of_outage = $dates_of_outage . date("Y-M-d H:i", strtotime($rows2['date_occ'])).'H to ';
    //$dates_of_outage = $dates_of_outage . date("Y-M-d H:i", strtotime($rows2['date_res'])).'H ['.$time_each_date.' hrs]<br>';
    $tempo_hour_holder = round($hour = abs($timestamp2 - $timestamp1)/(60*60), 3);
    $total_hours_holder = $total_hours_holder + $tempo_hour_holder;
    $number_of_outages++;
}  
?>