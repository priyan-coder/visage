<?php
	session_start();
	if(isset($_SESSION['uname'])){
	    $Welcome_msg = "Welcome ".$_SESSION['uname']."!";
	    $User_Name = $_SESSION['uname'];
		//echo $User_Name;
		//echo "<script>location.href = 'welcome.php';</script>";
	    //echo $Welcome_msg;
	    // echo "<script>
	    // 	document.getElementById('welcome_text').innerHTML = ".$Welcome_msg.";
	    // </script>";

	    $con = mysqli_connect("localhost", "root", "");

	    if(!$con){
	    	echo "<script>alert('Cannot connect to the server');</script>";
	    } 

	    if(!mysqli_select_db($con, "pitstawp")){
	    	echo "<script>alert('Cannot connect to the database');</script>";
	    }

	    $Waist_Size = 0;
	    $Shoulder_Size = 0;

	    $check_waist_size = "SELECT waist_size FROM user WHERE username = '$User_Name'";
	    $result_waist_size = mysqli_query($con, $check_waist_size); 

	    while($row = $result_waist_size -> fetch_assoc()){
	    	$Waist_Size = (int)$row['waist_size'];
	    }

	   	$check_shoulder_size = "SELECT shoulder_size FROM user WHERE username = '$User_Name'";
	    $result_shoulder_size = mysqli_query($con, $check_shoulder_size); 

	    while($row = $result_shoulder_size -> fetch_assoc()){
	    	$Shoulder_Size = (int)$row['shoulder_size'];
	    }


	} else {
		session_destroy();
		echo "<script>location.href = 'index.html';</script>";
	}
?> 


<!DOCTYPE html>
<html>
<head>
	<title></title>
				<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="css/clothing.css"  rel="stylesheet" type="text/css"/>

</head>
<body style="background:#cecece row">

<div class="col-md-6 col-0-gutter">	
	<!-- Slideshow container -->
<div class="slideshow-container" style="margin-top:80px;">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <div class="numbertext">1 / 4</div>
    <img src="images/dress/1.jpg" style="height:400px; margin: 0 auto;"/>
    <div class="text">Caption Text</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 4</div>
    <img src="images/dress/3.jpg" style="height:400px">
    <div class="text">Caption Two</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 4</div>
    <img src="images/dress/4.jpg" style="height:400px">
    <div class="text">Caption Three</div>
  </div>

    <div class="mySlides fade">
    <div class="numbertext">4 / 4</div>
    <img src="images/dress/5.jpg" style="height:400px">
    <div class="text">Caption Three</div>
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span>
  <span class="dot" onclick="currentSlide(4)"></span> 
</div>
</div>

<div class="col-md-6 col-0-gutter" style="margin-top:80px;">
	<h3>Product Name: </h3>
	<p id="product_name"></p>

	<h3>Waist Size: </h3>
	<p id="product_waist_size"></p>

	<h3>Shoulder Size: </h3>
	<p id="product_shoulder_size"></p>

	<h3>Product Cost: </h3>
	<p id="product_cost"></p>

	<h3>Our opinion: </h3>
	<p id="product_feedback" style="color:red;"></p>
</div>


	<script type="text/javascript">

	var shoulder_size = <?php echo $Shoulder_Size;?>;
	var waist_size = <?php echo $Waist_Size;?>;

	//alert(shoulder_size);
	//alert(waist_size);

	var product_info = [
		["Red-black dress", 380, 580, "$68"],
		["Red-cross dress", 450, 550, "$20"],
		["Red glown", 150, 320, "$120"],
		["Plain Red Dress", 500, 1000, "$30"]
	];

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";

  document.getElementById("product_name").innerHTML = product_info[slideIndex-1][0];
  document.getElementById("product_waist_size").innerHTML = "Maximum waist size "+product_info[slideIndex-1][1];
  document.getElementById("product_shoulder_size").innerHTML = "Maximum shoulder size"+product_info[slideIndex-1][2];
  document.getElementById("product_cost").innerHTML = product_info[slideIndex-1][3];



   var shoulder_feedback= "";
   var waist_feedback ="";

   if((shoulder_size + 30) < product_info[slideIndex-1][2]){
   	shoulder_feedback = "This dress will fit you at the shoulder. \n";
   } else if(shoulder_size < product_info[slideIndex-1][2]){
   	shoulder_feedback = "This dress will fit your shoulders nicely. \n";
   } else { 
   	shoulder_feedback = "This dress might be too loose for you at the shoulders. ";
   }

   if((waist_size + 30) < product_info[slideIndex-1][1]){
   	waist_feedback = "The dress will fit you at your waist. \n";
   } else if(waist_size < product_info[slideIndex-1][1]){
   	waist_feedback = "The dress will fit your waist nicely. \n";
  } else {
  	waist_feedback = "The dress might be too lose at your waist. \n";
  }

  document.getElementById("product_feedback").innerHTML = waist_feedback + shoulder_feedback;

  //alert(product_info[0][1]);


}
	</script>
</body>
</html>
