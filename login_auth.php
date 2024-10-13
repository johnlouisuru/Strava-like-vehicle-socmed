<?php 
	include_once('db/conn.php');
	if(isset($_POST['submit'])){
		$username = md5($_POST['username']);
		$password = md5($_POST['password']);
		$query = "select * from gf_details WHERE gf_user='$username' AND gf_pass='$password' LIMIT 1";
		$authen = mysqli_query($db,$query);
		if(mysqli_num_rows($authen)>=1){
			while($rows=mysqli_fetch_array($authen)){
				$gf_name = $rows['gf_name'];
				$gc_id = $rows['gc_id'];
				$gf_id = $rows['id'];
				$grid = $rows['grid'];
				$region = $rows['region'];
			}
			$_SESSION["gf_name"] = $gf_name;
			$_SESSION["gc_id"] = $gc_id;
			$_SESSION["gf_id"] = $gf_id;
			$_SESSION["grid"] = $grid;
			$_SESSION["region"] = $region;
			//require('activity_logs.php');
			echo "WELCOME ".$_SESSION['gf_name'].'<br>';
			echo "<meta http-equiv=\"refresh\" content=\"1;url=add_outage.php\"/>";
			
		}
		else {
			echo "Incorrect Username or Password!";
			//echo "ERROR: Could not able to execute $query. " . mysqli_error($db);
			echo "<meta http-equiv=\"refresh\" content=\"1;url=log_in.php\"/>";
		}
		//phpinfo();
	}
	/*include('emailing.php');
    $message_holder = 'Account with Username: '.$username.' Logged in';
    emailing($message_holder);*/
	//echo "Account Successfully LOGGED IN!";
	//echo "<meta http-equiv=\"refresh\" content=\"1;url=add_outage.php\"/>";
?>