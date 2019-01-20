<?php
	
	session_start();
	if(isset($_SESSION['uname'])){
	    echo "<script>location.href ='welcome.php';</script>";
	} else if(isset($_POST['login_button'])){
		$User_Name = $_POST['login_username'];
		$User_Password = $_POST['login_pwd'];

		$con = mysqli_connect("localhost", "root", "");

		if(!$con){
			echo "Cannot connect to server";
			//echo "<script>alert("Cannot connect to server");</script>";
		}

		if(!mysqli_select_db($con, "pitstawp")){
			echo "Database not selected";
			//echo "<script>alert("Database  not selected");</script>";
		}

		$check_username = "SELECT password FROM user WHERE username = '$User_Name'";
		$result_username = mysqli_query($con, $check_username);
		//echo $result_username;

		while ($row = $result_username->fetch_assoc()) {
	    	 if($row['password'] == $User_Password){
	    	 	echo "success";
	    	 	$_SESSION['uname'] = $User_Name;
	    	 	echo "<script>location.href = 'welcome.php';</script>";
	    	 } else {
	    	 	echo "<script>alert('Incorrect username or password');</script>";
	    	 	echo "<script>location.href = 'index.html';</script>";
	    	 }
		}
	}

	
?>