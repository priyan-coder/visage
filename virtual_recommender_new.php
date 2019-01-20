	<?php
	
	session_start();
	$User_Name = $_SESSION['uname'];
	if(isset($_SESSION['uname'])){
		$User_Name = $_SESSION['uname'];
		echo $User_Name;
	} else {
		echo "Unsuccessful";
	}

	$data_validified = true;
	if(isset($_POST['submit_picture'])){
		$file = $_FILES['file'];
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

		if($data_validified == true){

		//SAVING THE IMAGE FILES IN RESPECTIVE FOLDERS
		//$fileNameNew = $User_Name."_front_view.".$fileAcualExt;
		$fileNameNew = "vr_image_".$User_Name.".".$fileAcualExt;
		$fileDestination = '/../../../../home/rishi_other/Downloads/visage-master/matching_clothes/test_shirts/'.$fileNameNew;

		move_uploaded_file($fileTmpName, $fileDestination);
		header("Location: virtual_intermediate.php");
		//header("Refresh: 3; url= 127.1.1.1/get_best_match");

		}else {
			echo "unsuccessful";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Virtual Recommender</title>
			<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="css/style.css" rel="stylesheet">
</head>
<body>
								<div class="col-lg-12 text-center" style="margin-top:50px;">
									<div id="success"></div>
									<img id="myimage1" src="https://developer.apple.com/library/archive/referencelibrary/GettingStarted/DevelopiOSAppsSwift/Art/defaultphoto_2x.png" height="500px" width="500px">
									<br/>
									
									<br/>
									<p>Close up Picture</p>
									<br/>
									<form method="post" id="input_form" enctype="multipart/form-data">
									<input type="file" style="text-align:center; margin:auto; padding-left: 120px;" onchange="onFileSelected1(event)" name="file">
									<br/>
									<br/>
									<input type="hidden" id="username_holder" name="user_id"/> 
									<input type="submit" value="submit" name="submit_picture"/>
								</form>
								</div>
								<script type="text/javascript">

									document.getElementById("username_holder").value = <?php echo $User_Name;?>;

			function onFileSelected1(event) {
  var selectedFile = event.target.files[0];
  var reader = new FileReader();

  var imgtag = document.getElementById("myimage1");
  imgtag.title = selectedFile.name;

  reader.onload = function(event) {
    imgtag.src = event.target.result;
  };

  reader.readAsDataURL(selectedFile);
}
								</script>
</body>
</html>
