<?php
	
	$data_validified = true; //when true, add the entry into the sql database

	$con = mysqli_connect("localhost", "root", "");

	if(!$con){
		echo "Not connected to database\n";
	} 

	if(!mysqli_select_db($con, "pitstawp")){
		echo "Database Not Selected\n";
	} 

	$User_Name = $_POST['username'];
	if($User_Name == '' || empty($User_Name)){
		$data_validified = false;
		echo "Username cannot be blank.\n";
	}

	$check_duplicate_username = "SELECT username FROM user WHERE username = '$User_Name'";

	$result_username = mysqli_query($con, $check_duplicate_username);
	$count_username = mysqli_num_rows($result_username);
	if($count_username > 0){
		$data_validified = false;
		echo "That username already exists. Please choose another one.\n";
	}

	$Email = $_POST['email'];

	$check_duplicate_email = "SELECT email FROM user WHERE email = '$Email'";
	$result_email = mysqli_query($con, $check_duplicate_email);
	$count_email = mysqli_num_rows($result_email);
	if($count_email > 0){
		$data_validified = false;
		echo "That email already exists.\n";
	}
	$Password1 = $_POST['password1'];
	$Password2 = $_POST['password2'];
	
	if($Password1 != $Password2){
		$data_validified = false;
		echo "Passwords do not match!\n";
	}

	//the image files
	//allow images
	//$allowed = array('jpg', 'jpeg', 'png');

	if(isset($_POST['submit-data'])){

		//GETTING DATA ON THE FIRST FILE IMAGE
		$file = $_FILES['file'];
		//print_r($file); //to see array data of file
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];

		//extract file type
		$fileExt = explode('.', $fileName);
		$fileAcualExt = strtolower(end($fileExt));

		//allow images
		$allowed = array('jpg', 'jpeg', 'png');

		if(in_array($fileAcualExt, $allowed)){
			if($fileError === 0){
				if($fileSize < 25000000){

					//header("Location:index.html?uploadSucess");
				} else {
					$data_validified = false;
					echo "Your file is too big";
				}
			} else {
				$data_validified = false;
				echo "There was an error uploading your file";
			}
		} else {
			$data_validified = false;
			echo "You cannot upload of this type";
		}

		//GETTING DATA ON THE SECOND FILE IMAGE
		$file2 = $_FILES['file2'];
		//print_r($file); //to see array data of file
		$file2Name = $_FILES['file2']['name'];
		$file2TmpName = $_FILES['file2']['tmp_name'];
		$file2Size = $_FILES['file2']['size'];
		$file2Error = $_FILES['file2']['error'];
		$file2Type = $_FILES['file2']['type'];

		//extract file type
		$file2Ext = explode('.', $file2Name);
		$file2AcualExt = strtolower(end($file2Ext));

		//allow images
		$allowed = array('jpg', 'jpeg', 'png');

		if(in_array($file2AcualExt, $allowed)){
			if($file2Error === 0){
				if($file2Size < 25000000){

					//header("Location:index.html?uploadSucess");
				} else {
					$data_validified = false;
					echo "Your file is too big";
				}
			} else {
				$data_validified = false;
				echo "There was an error uploading your file";
			}
		} else {
			$data_validified = false;
			echo "You cannot upload of this type";
		}

		//GETTING DATA ON THE THIRD FILE IMAGE
		$file3 = $_FILES['file3'];
		//print_r($file); //to see array data of file
		$file3Name = $_FILES['file3']['name'];
		$file3TmpName = $_FILES['file3']['tmp_name'];
		$file3Size = $_FILES['file3']['size'];
		$file3Error = $_FILES['file3']['error'];
		$file3Type = $_FILES['file3']['type'];

		//extract file type
		$file3Ext = explode('.', $file3Name);
		$file3AcualExt = strtolower(end($file3Ext));

		//allow images
		$allowed = array('jpg', 'jpeg', 'png');

		if(in_array($file3AcualExt, $allowed)){
			if($file3Error === 0){
				if($file3Size < 25000000){

					//header("Location:index.html?uploadSucess");
				} else {
					$data_validified = false;
					echo "Your file is too big";
				}
			} else {
				$data_validified = false;
				echo "There was an error uploading your file";
			}
		} else {
			$data_validified = false;
			echo "You cannot upload of this type";
		}
	}


	//front view - image 1
	// $file1 = $_FILES['file1'];
	// $file1Name = $_FILES['file1']['name'];
	// $file1TmpName = $_FILES['file1']['tmp_name'];
	// $file1Size = $_FILES['file1']['size'];
	// $file1Error = $_FILES['file1']['error'];
	// $file1Type = $_FILES['file1']['type'];
	// //extract file type
	// $file1Ext = explode('.', $file1Name);
	// $file1AcualExt = strtolower(end($file1Ext));

	// //side view - image 2
	// $file2 = $_FILES['file2'];
	// $file2Name = $_FILES['file2']['name'];
	// $file2TmpName = $_FILES['file2']['tmp_name'];
	// $file2Size = $_FILES['file2']['size'];
	// $file2Error = $_FILES['file2']['error'];
	// $file2Type = $_FILES['file2']['type'];
	// //extract file type
	// $file2Ext = explode('.', $file2Name);
	// $file2AcualExt = strtolower(end($file2Ext));

	// //rear view - image 3
	// $file3 = $_FILES['file3'];
	// $file3Name = $_FILES['file3']['name'];
	// $file3TmpName = $_FILES['file3']['tmp_name'];
	// $file3Size = $_FILES['file3']['size'];
	// $file3Error = $_FILES['file3']['error'];
	// $file3Type = $_FILES['file3']['type'];
	// //extract file type
	// $file3Ext = explode('.', $file3Name);
	// $file3AcualExt = strtolower(end($file3Ext));

	// //image validation
	// if(in_array($file1AcualExt, $allowed) && in_array($file2AcualExt, $allowed) && in_array($file3AcualExt, $allowed)){
	// 	if($file1Error === 0 && $file2Error === 0 && $file3Error === 0){
	// 		if($file1Size < 25000000 && $file2Size < 25000000 && $fileS3ize < 25000000){
	// 			// $file1NameNew = uniqid('', true).".".$file1AcualExt;
	// 			// $file1Destination = 'uploads/'.$file1NameNew;

	// 			// move_uploaded_file($fileTmpName, $fileDestination);
	// 			// header("Location:index.html?uploadSucess");
	// 		} else {
	// 			$data_validified = false;
	// 			echo "Your file is too big";
	// 		}
	// 	} else {
	// 		$data_validified = false;
	// 		echo "There was an error uploading your file";
	// 	}
	// } else {
	// 	$data_validified = false;
	// 	echo "You cannot upload of this type extension";
	// }

	if($data_validified == true){

		//SAVING THE IMAGE FILES IN RESPECTIVE FOLDERS
		//$fileNameNew = $User_Name."_front_view.".$fileAcualExt;
		$fileNameNew = "image_".$User_Name.".".$fileAcualExt;
		$fileDestination = '/../../../../home/rishi_other/Downloads/visage-master/users/'.$fileNameNew;

		move_uploaded_file($fileTmpName, $fileDestination);

		//$file2NameNew = $User_Name."_side_view.".$file2AcualExt;
		$file2NameNew = "image_body_frontal_".$User_Name.".".$fileAcualExt;
		$file2Destination = '/../../../../home/rishi_other/Downloads/visage-master/users/'.$file2NameNew;

		move_uploaded_file($file2TmpName, $file2Destination);


		//$file3NameNew = $User_Name."_rear_view.".$file3AcualExt;
		$file3NameNew = "image_body_side_".$User_Name.".".$fileAcualExt;	
		$file3Destination = '/../../../../home/rishi_other/Downloads/visage-master/users/'.$file3NameNew;

		move_uploaded_file($file3TmpName, $file3Destination);


		// $file1NameNew = uniqid('', true).".".$file1AcualExt;
		// $file1Destination = 'uploads/'.$file1NameNew;



		// $file1NameNew = $User_Name."_front_view.".$file1AcualExt;
		// $file2NameNew = $User_Name."_side_view.".$file2AcualExt;
		// $file3NameNew = $User_Name."_rear_view.".$file3AcualExt;

		// $file1Destination = 'uploads/'.$file1NameNew;
		// $file2Destination = 'uploads/'.$file2NameNew;
		// $file3Destination = 'uploads/'.$file3NameNew;

		// move_uploaded_file($file1NameNew, $file1Destination);
		// move_uploaded_file($file2NameNew, $file2Destination);
		// move_uploaded_file($file3NameNew, $file3Destination);





		//header("Location:index.html?uploadSucess");

		//UPLOADING DATA TO MYSQL
		$sql = "INSERT INTO user (username, password, email) VALUES ('$User_Name', '$Password1', '$Email')";

		if(!mysqli_query($con, $sql)){
			echo $User_Name;
			echo $Email;
			echo $Password1;
			echo "Not registered";
		} else {			
			echo "Registered";
		}

		//header("refresh:2; url=index.html");

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload Pictures</title>
</head>
<body>

	<button onclick="submit_username_form()">Click to go back</button>
	<script type="text/javascript">

					function submit_username_form(){
						var username = "<?php echo $User_Name; ?>";
						var form = document.createElement("form");
						
						var element1 = document.createElement("input");
						element1.setAttribute("type", "hidden");


						
						form.method = "POST";
						form.action = "http://127.0.0.1:5000/get_dimensions"; //submit the form to rishi

						element1.value = username; //get username from php
						element1.name = "user_id";

						form.appendChild(element1);

						document.body.appendChild(form);
						//alert(username);
						form.submit();
					}

	</script>

</body>
</html>
