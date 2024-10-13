<?php 
	include_once('db/conn.php');
	if(isset($_POST['submit'])){
		$username = md5($_POST['username']);
		$password = md5($_POST['password']);
		$query = "select * from admin WHERE user='$username' AND pass='$password' LIMIT 1";
		$authen = mysqli_query($db,$query);
		if(mysqli_num_rows($authen)>=1){
			while($rows=mysqli_fetch_array($authen)){
				$admin_id = $rows['id'];
				$is_admin = $rows['is_admin'];
				$admin_email = $rows['email'];
			}
			$_SESSION["is_admin"] = $is_admin;
			$_SESSION["admin_id"] = $admin_id;
			$_SESSION["admin_email"] = $admin_email;
			//require('activity_logs.php');
			echo "WELCOME ".$_SESSION['admin_email'].'<br>';
			echo "<meta http-equiv=\"refresh\" content=\"1;url=dashboard.php\"/>";
			
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