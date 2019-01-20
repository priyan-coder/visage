<?php
	
	session_start();
	$User_Name = $_SESSION['uname'];
	if(isset($_SESSION['uname'])){
		$User_Name = $_SESSION['uname'];
		echo $User_Name;
	} else {
		echo "Unsuccessful";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<script type="text/javascript">
						var username = "<?php echo $User_Name; ?>";
						var form = document.createElement("form");
						var element1 = document.createElement("input");

						form.method = "POST";
						form.action = " http://127.1.1.1:5000/get_best_match"; //submit the form to rishi

						element1.value = username; //get username from php
						element1.name = "user_id";

						form.appendChild(element1);

						document.body.appendChild(form);
						form.submit();
	</script>
</body>
</html>
