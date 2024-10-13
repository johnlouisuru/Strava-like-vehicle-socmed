<!DOCTYPE html>
<html lang="en">

<?php 
require("db/conn.php");
if(!@$_SESSION['gc_id'] || !@$_SESSION['gf_id']){
  header('Location: log_in.php');
  die();
}

require('head.php');
require('fb_time_ago.php');
if(!empty($_GET['q'])){
  $flag = 0;
  $orig_unit_id_holder = 0;
  $get_if_q_valid = mysqli_query($db, "SELECT * FROM outage_event");
  if(mysqli_num_rows($get_if_q_valid)){
    while($valid_q = mysqli_fetch_assoc($get_if_q_valid)){
      if($_GET['q'] == md5($valid_q['unit_id'])){
          $flag++;
          $orig_unit_id_holder = $valid_q['unit_id'];
          $too_holder = $valid_q['too'];
          $too_desc_holder = $valid_q['too_description'];
          $oc_holder = $valid_q['outage_class'];
          $total_outage_holder = $valid_q['total_outage'];
          $date_occ_holder = $valid_q['date_occ'];
          $reason_holder = $valid_q['reason'];

      }
    }
  
      $query_unit_name = mysqli_query($db,"select * from gu_details WHERE id=$orig_unit_id_holder");
      $result4 = $query_unit_name->fetch_assoc();  
      $un = $result4['unit_name'];
    
  }
  if($flag == 0){
    echo "<h1>You Are UNAUTHORIZED!</h1>";
    exit();
  }
}
else {
  echo "<h1>You Are UNAUTHORIZED!</h1>";
  exit();
}

  ?>
<head>
    <style>
          .timepicker {
            border: 1px solid rgb(163, 175, 251);
            text-align: center;
            display: inline;
            border-radius: 4px;
            padding:2px;
        }

            .timepicker .hh, .timepicker .mm {
                width: 130px;
                outline: none;
                border: none;
                text-align: center;
            }

            .timepicker.valid {
                border: solid 1px springgreen;
            }

            .timepicker.invalid {
                border: solid 1px red;
            }

    </style>

  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

  <script>

    $(document).ready(function() {

      $(".hh").blur(function () {
            if ($(this).val() >= 24)
                $(this).val($(this).val() % 24);

            if ($(this).val() == "")
                $(this).val("");
            else
                if ($(this).val() < 10)
                    $(this).val("0" + parseInt($(this).val()));
      validateTime(x);
        });
        $(".mm").blur(function () {
            if ($(this).val() >= 60)
                $(this).val($(this).val() % 60);

            if ($(this).val() == "")
                $(this).val("");
            else
                if ($(this).val() < 10)
                    $(this).val("0" + parseInt($(this).val()));

            var x = $(this).parent().attr("class").split(" ")[1];
            validateTime(x);
        });

        $(".hh").on("input", function () {
            $(this).parent().removeClass("invalid").removeClass("valid");
            if ($(this).val().length == 2)
                $(this).siblings(".mm").focus().select();
        });
        $(".mm").on("input", function () {
            $(this).parent().removeClass("invalid").removeClass("valid");
            if ($(this).val().length == 2)
                $(this).blur();
        });
    $(".hh").on("focus", function () {
            $(this).parent().removeClass("invalid").removeClass("valid");
        });
    $(".mm").on("focus", function () {
            $(this).parent().removeClass("invalid").removeClass("valid");
        });

        function getTime(x) {
            var t = $(".timepicker." + x).find(".hh").val() + ":" + $(".timepicker." + x).find(".mm").val();
      var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(t);
      var res = t ;
            if (!isValid)
                res = null;
            return res;
        }

        function validateTime(x) {
      var t = $(".timepicker." + x).find(".hh").val() + ":" + $(".timepicker." + x).find(".mm").val();
            var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(t);
            if (isValid) {
                $(".timepicker." + x).removeClass("invalid").addClass("valid");
            } else {
                $(".timepicker." + x).removeClass("valid").addClass("invalid");
            }

        }

        function setTime(x, t) {
            $(".timepicker." + x).children(".hh").val(t.substring(0, 2));
            $(".timepicker." + x).children(".mm").val(t.substring(3, 5));
            validateTime(x);
        }
    
    $(".btnGetTime").click(function(){
      alert(getTime("timepicker1"));
    });
    
    $(".btnSetTime").click(function(){
      setTime("timepicker1" , "10:35");
    });
    
    $("html").on('input' , ".N" , function () {
      $(this).val($(this).val().replace(/[^0-9.]/g, ""));
    });

    //end of 24-hour format


      $('#submit_outage_event').prop('disabled',true);
        $('input:checkbox').click(function() {
          if ($(this).is(':checked')) {
           $('#submit_outage_event').prop("disabled", false);
           } else {
           if ($('.checks').filter(':checked').length < 1){
           $('#submit_outage_event').attr('disabled',true);}
           }
        });

    

     $('#submit_outage_event').on("click", function() {
      //alert(parseInt(total_outage));
      $('.modal').show();
         var date_of_res = $('#date_of_res').val();
         var unit_id = $('#unit').val();
         var time_hh = $('.hh').val();
         var time_mm = $('.mm').val();
         var time_of_res = time_hh+':'+time_mm;
         if(unit_id == null || unit_id == ''){
          $('.modal').hide();
              var sel2 = $(".toast-body");
              sel2.empty();
              sel2.append("Error With The Unit to be Updated.");
              $('.toast').toast('show');
         }
         else if(date_of_res== null || date_of_res== ''){
          $('.modal').hide();
              var sel2 = $(".toast-body");
              sel2.empty();
              sel2.append("Please Select a valid Resumption Date");
              $('.toast').toast('show');
         }
         else if(time_hh == null || time_hh == ''){
          $('.modal').hide();
              var sel2 = $(".toast-body");
              sel2.empty();
              sel2.append("Please Input Hour Time of Occurrence");
              $('.toast').toast('show');
         }
         else if(time_mm == null || time_mm == ''){
          $('.modal').hide();
              var sel2 = $(".toast-body");
              sel2.empty();
              sel2.append("Please Input Minute Time of Occurrence");
              $('.toast').toast('show');
         }
         else {
              var formData = {
              date_of_res_ : date_of_res,
              time_of_res_ : time_of_res,
              unit_id_     : unit_id
            };

          $.ajax({
              type: "POST",
              url: "process_resume_outage_event.php",
              data: formData,
              dataType: "json",
              encode: true,
            }).done(function(data) {
              $('.modal').hide();
              var sel3 = $("#success_message");
                sel3.empty();
              if(data["message"] == "SUCCESS"){
                
                sel3.append('<p class="alert alert-success">Outage Event Successfully Resumed. You will be redirected in 1...</p>');
                //document.getElementById("success_message").innerHTML = "";
                document.getElementById("submit_outage_event").disabled = true;
                setTimeout("window.location = 'resumed_outage.php';",3000);
              }
              else {
                    sel3.append(data["message"]);
              }
              var sel2 = $(".toast-body");
              sel2.empty();
              sel2.append(data["message"]);
              $('.toast').toast('show');
              
            });
         }
         
        
             event.preventDefault();
     });
     
     
    });
  </script>
</head>
<body>

  <?php 
    require('header.php');
  ?>

<?php 
    require('sidebar.php');

  ?>

  <!-- BODY CONTENT -->
  <main id="main" class="toggle-sidebar">

    <div class="pagetitle">
      <h1><i class="bi bi-lightning-fill"></i> RESUME <i><?=$un?></i> FROM OUTAGE EVENT </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Resumption</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!-- Toast with Placements -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11" data-bs-autohide="false">
  <div id='liveToast'
  class="toast"
  role="alert"
  aria-live="assertive"
  aria-atomic="true">
              <div class="toast-header" >
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Notification</div>
                <small id='minutes'>Just Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body alert alert-danger">
        </div>
      </div>
    </div>
              <!-- Toast with Placements -->

              <div class="modal" id="myModal" tabindex="-1" style="position: fixed; top: 25%;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Standby, while your request is still processing...</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Please Wait while sending your request...</p>
                  <div class="col-12" id="lowding">
                    <div class="spinner-grow text-primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-warning" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-dark" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
              </div>
                </div>
              </div>
            </div>
          </div>
    
              <!-- LOADING KEMERUT -->


    <section class="section home">
      <div class="row">



        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div id="success_message"></div>
                <hr />
              <h5 class="card-title"><i class="bi bi-repeat"></i> Submit Date of Resumption</h5>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date of Resumption</label>
                  <div class="col-sm-10">
                    <input type="date" id="date_of_res" class="form-control">
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Time of Resumption (24-Hour)</label>
                  <div class="col-sm-10">
                     <div class="timepicker timepicker1" dir="ltr">
                      <input type="text" class="hh N" min="0" max="23" placeholder="hh" maxlength="2" />:
                      <input type="text" class="mm N" min="0" max="59" placeholder="mm" maxlength="2" />
                      </div>
                  </div>
                </div>
                <hr />
              <h5 class="card-title">Outage Event Details of <u><?=$un?></u></h5>

             <!-- DITO LAHAT NG UNIT NA MERON SI GENERATING FACILITY -->

             <!-- General Form Elements -->
              

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Type of Outage</label>
                  <div class="col-sm-10">
                    <input type="hidden" class="form-control" value="<?=$too_holder?>" id="type_of_outage" aria-label="Type of Outage">
                    <?php 
                      $query_ot = mysqli_query($db,"select * from type_of_outage WHERE id=$too_holder");
                      $result4 = $query_ot->fetch_assoc();  
                      $ot = $result4['outage_type'];
                    ?>
                    <p class="alert alert-success"><?=$ot?></p>
                </div>
              </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Outage Description</label>
                  <div class="col-sm-10">
                    <input type="hidden" class="form-control" value="<?=$too_desc_holder?>" id="outage_description" aria-label="Type of Outage">
                    <?php 
                      $query_desc = mysqli_query($db,"select * from type_of_outage_description WHERE too_id=$too_holder AND id=$too_desc_holder");
                      $result4 = $query_desc->fetch_assoc();  
                      $desc = $result4['description'];
                    ?>
                    <p class="alert alert-success"><?=$desc?></p>
                  </div>
                </div>
                    <input type="hidden" class="form-control" value="<?=$orig_unit_id_holder?>" id="unit" aria-label="Unit">
                   
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Total Outage (MW)</label>
                  <div class="col-sm-10">
                    <input type="hidden" class="form-control" value="<?=$total_outage_holder?>" id="total_outage">
                     <p class="alert alert-success"><?=$total_outage_holder?> (MW)</p>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Date Occurred</label>
                  <div class="col-sm-10">
                    
                     <p class="alert alert-success"><?=date("d-M-Y H:i", strtotime($date_occ_holder));?>H</p>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Detailed Reason for Outage</label>
                  <div class="col-sm-10">
                    <p class="alert alert-success"><?=$reason_holder?></p>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Outage Classification</label>
                  <div class="col-sm-10">
                   <?php 
                      $query_oc = mysqli_query($db,"select * from outage_class WHERE id=$oc_holder");
                      $result4 = $query_oc->fetch_assoc();  
                      $cn = $result4['class_name'];
                    ?>
                    <p class="alert alert-success"><?=$cn?></p>
                  </div>
                </div>

                    <hr />


                <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="verify validationDefault04" onclick="$('#bookit').attr('disabled', !$(this).is(':checked'));" required>
                      <label class="form-check-label" for="flexCheckChecked">
                        By checking this, all details provided are correct.
                      </label>
                      <div class="invalid-feedback">By checking this, all details provided are correct.</div>
                    </div>
                    <br>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" id="submit_outage_event" class="btn btn-primary" disabled>Submit Outage Event Report</button>
                  </div>
                </div>

             <!-- End General Form Elements -->

             <!-- end ito ng DITO LAHAT NG UNIT NA MERON SI GENERATING FACILITY -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <script>
const timeInput = document.getElementById("timeInput");
timeInput.addEventListener("input", function () {
  const value = this.value.replace(/[^0-9]/g, "");
  if (value.length > 2) {
    this.value = value.slice(0, 2) + ":" + value.slice(2);
  }
});
</script>

  </main><!-- End #main -->

  <!-- BODY CONTENT -->

  <?php 
    //require('footer.php');
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  

</body>

</html>