<?php
	session_start();
	if(isset($_SESSION['uname'])){
	    $Welcome_msg = "Welcome ".$_SESSION['uname']."!";
	    //echo $Welcome_msg;
	    // echo "<script>
	    // 	document.getElementById('welcome_text').innerHTML = ".$Welcome_msg.";
	    // </script>";
	} else {
		session_destroy();
		echo "<script>location.href = 'index.html';</script>";
	}
?> 

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<title>E-commerce</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="css/style.css" rel="stylesheet">
		<link href="css/style-2.css" rel="stylesheet">
	</head>
	<body id="page-top">
		<!-- Navigation -->
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand page-scroll" href="#page-top"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden">
							<a href="#page-top"></a>
						</li>
						<li>
							<a class="page-scroll" href="#about">About</a>
						</li>
						<li>
							<a class="page-scroll" href="#team">Team</a>
						</li>
						<li style = "cursor:pointer;">
							<!-- <a class="page-scroll" type="submit" name="log_out_button">Log Out</a> -->

							<a class="page-scroll" onclick="event.preventDefault();
							    document.getElementById('magic-form').submit();">
							    Log Out
							</a>
							<form id="magic-form" action="logout.php" 
							      method="POST" style="display: none;">
							      <!-- {{ csrf_field() }}  --><!-- from your framework -->
							      <input type="hidden" name="field1" value="value1" />
							      <!-- other fields -->
							</form>
						</li>
						
					</ul>
					</ul>
					</ul>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
		


<!-- <form class="form-inline" action="login.php" style="float:right; margin-right:40px;" method="post">
  <div class="form-group">
    <label for="username">Username: </label>
    <input type="text" name="login_username" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="login_pwd" class="form-control" id="pwd">
  </div>
  <input type="submit" name="login_button" value="Submit" class="btn btn-default">
</form> -->

	<h2 style="float:right; margin-right:200px;" id="welcome_text"><b>Welcome</b></h2>
		<section id="portfolio">
			<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>Pit-Stawp</h2>
						<p>Your trusted virtual partner<p>
					</div>
				</div>
			</div>
			<div class="row row-0-gutter">
				<!-- start portfolio item -->
				<div class="col-md-6 col-0-gutter">
					<div class="ot-portfolio-item">
						<figure class="effect-bubba">
							<img src="images/Model/glasses.jpg" alt="img02" class="img-responsive" width ="1000" />
							<figcaption>
								<h2>Glasses</h2>
								<p>Spectacles, Sunglasses</p>
								<a href="#" data-toggle="modal" data-target="#Modal-1">View more</a>
							</figcaption>
						</figure>
					</div>
				</div>
				<!-- end portfolio item -->
				<!-- start portfolio item -->
				<div class="col-md-6 col-0-gutter">
					<div class="ot-portfolio-item">
						<figure class="effect-bubba">
							<img src="images/Model/lipstick.jpg" alt="img02" class="img-responsive" width ="1000" />
							<figcaption>
								<h2>Facial Products</h2>
								<p>Lipsticks</p>
								<a href="#" data-toggle="modal" data-target="#Modal-2">View more</a>
							</figcaption>
						</figure>
					</div>
				</div>
				<!-- end portfolio item -->
			</div>
			<div class="row row-0-gutter">
				<!-- start portfolio item -->
				<div class="col-md-6 col-0-gutter" id="abhishek">
					<div class="ot-portfolio-item">
						<figure class="effect-bubba">
							<!-- the following dont seem working. Tries the code but still the image is not centred.--> 
							<div. effect-bubba{
						    height: 10em;/
						    position: relative} >
								<img src="images/Model/dress.jpg" alt="img02" class="img-responsive" width ="1000" />
							<figcaption>
								<h2>Clothing</h2>
								<p>Dresses</p>
								<a href="#" data-toggle="modal" data-target="#Modal-3">View more</a>
							</figcaption>
						</figure>
					</div>
				</div>
				<!-- end portfolio item -->
			
			</div>
			</div><!-- container -->
		</section>

		<section id="about" class="mz-module">
			<div class="container light-bg">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-title">
							<h2>ABOUT</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 text-center">
						<div class="mz-about-container">
<div class="row">
  <div class="column" style="background-color:#aaa;">
    <h2>Create Form</h2>
   <form action = "http://127.0.0.1:5000/put_glasses" method = "POST">
         <p>User id <input type = "text" name = "user_id" /></p>
 	<p>Product id <input type = "text" name = "product_id" /></p>
         <p><input type = "submit" value = "submit" /></p>    
</form>
  </div>
							<p>Pit-Stawp is an E-commerce website authentically built for virtual trial of an array of products from various brands. Some the products which feature include glasses, spectacles & clothing. This application aims to assist potential custormers on choosing the right products for their individual tastes and prefereneces. </p>
						</div>
					</div>
					<div class="col-md-6">
						
				</div>
				<div class="row row-0-gutter">
				</div>
			</div>
			<!-- /.container -->
		</section>

		<section id="team">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-title">
							<h2>Our Team</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- team member item -->
					<div class="col-md-3">
						<div class="team-item">
							<div class="team-image">
								<img src="images/demo/author-2.jpg" class="img-responsive" alt="author">
							</div>
							<div class="team-text">
								<h3>Rishi Mahadevan</h3>
								<div class="team-position">Software Development</div>
								<p>Worked on the primary software required for the visual try on tool.</p>
							</div>
						</div>
					</div>
					<!-- end team member item -->
					<!-- team member item -->
					<div class="col-md-3">
						<div class="team-item">
							<div class="team-image">
								<img src="images/developers/samuel.jpg" class="img-responsive" alt="author">
							</div>
							<div class="team-text">
								<h3>Samuel Suther David</h3>
								<div class="team-position">Back-end Web Development</div>
								<p>Worked on the logical back-end and core computational logic of the website.</p>
							</div>
						</div>
					</div>
					<!-- end team member item -->
					<!-- team member item -->
					<div class="col-md-3">
						<div class="team-item">
							<div class="team-image">
								<img src="images/developers/abhishek.jpg" class="img-responsive" alt="author">
							</div>
							<div class="team-text">
								<h3>Karnati Sai Abhishek</h3>
								<div class="team-position">Front-End Web Development & Web design</div>
								<p>Worked on the interactive e-commerce website for potential customers.</p>
							</div>
						</div>
					</div>
					<!-- end team member item -->
					<!-- team member item -->
					<div class="col-md-3">
						<div class="team-item">
							<div class="team-image">
								<img src="images/developers/priyan.jpg" class="img-responsive" alt="author">
							</div>
							<div class="team-text">
								<h3>Priyan Rajamohan</h3>
								<div class="team-position">Front-End Web Development & Marketing</div>
								<p>Worked on detailing & customisation of website.</p>
							</div>
						</div>
					</div>
					<!-- end team member item -->
				</div>
			</div>
		</section>

<!-- 		<section id="contact">
 -->			<!-- <div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-title">
							<h2> Register & Upload :) </h2>
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 text-center">
						<form name="sentMessage" id="contactForm" novalidate="" action="register.php" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Please enter your Username" id="name" required="" data-validation-required-message="Please enter your name." name="username">
										<p class="help-block text-danger"></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" name="email" class="form-control" placeholder="Please enter your Email" id="email" required="" data-validation-required-message="Please enter your email address.">
										<p class="help-block text-danger"></p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="password" name="password1" class="form-control" placeholder="Please enter your Password" id="name" required="" data-validation-required-message="Please enter your password.">
										<p class="help-block text-danger"></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="password" name="password2" class="form-control" placeholder="Please re-enter your Password" id="email" required="" data-validation-required-message="Please re-enter your password.">
										<p class="help-block text-danger"></p>
									</div>
								</div>
							</div>
							<div class = "row">
									<div class="col-lg-4 text-center">
									<div id="success"></div>
									<img id="myimage1" src="https://developer.apple.com/library/archive/referencelibrary/GettingStarted/DevelopiOSAppsSwift/Art/defaultphoto_2x.png" height="200px" width="200px">
									<br/>
									<br/>
									<button id type="submit" class="btn"><img src="https://static.thenounproject.com/png/693309-200.png" height="40px" width="40px"></button>
									<br/>
									<br/>
									<input type="file" onchange="onFileSelected1(event)" name="file">
								</div>
								<div class="col-lg-4 text-center">
									<div id="success"></div>
									<img id="myimage2" src="https://developer.apple.com/library/archive/referencelibrary/GettingStarted/DevelopiOSAppsSwift/Art/defaultphoto_2x.png" height="200px" width="200px">
									<br/>
									<br/>
									<button type="submit" class="btn"><img src="https://static.thenounproject.com/png/693309-200.png" height="40px" width="40px"></button>
									<br/>
									<br/>
									<input type="file" name="file2" onchange="onFileSelected2(event)">
								</div>
								<div class="col-lg-4 text-center">
									<div id="success"></div>
									<img id="myimage3" src="https://developer.apple.com/library/archive/referencelibrary/GettingStarted/DevelopiOSAppsSwift/Art/defaultphoto_2x.png" height="200px" width="200px">
									<br/>
									<br/>
									<button type="submit" class="btn"><img src="https://static.thenounproject.com/png/693309-200.png" height="40px" width="40px"></button>
									<br/>
									<br/>
									<input type="file" name="file3" onchange="onFileSelected3(event)" class="btn">
								</div>
							</div> -->
<!-- 							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="form-control" placeholder="Your Message *" id="message" required="" data-validation-required-message="Please enter a message."></textarea>
										<p class="help-block text-danger"></p>
									</div>
								</div>
								<div class="clearfix"></div>
							</div> -->


<!-- 							<div class="row">
								<div class="col-lg-4 text-center">
									<div id="success"></div>
									<button type="submit" class="btn">Upload Front View</button>
								</div>
								<div class="col-lg-4 text-center">
									<div id="success"></div>
									<button type="submit" class="btn">Upload Side View</button>
								</div>
								<div class="col-lg-4 text-center">
									<div id="success"></div>
									<button type="submit" class="btn">Upload Rear View</button>
								</div>
							</div>
							<br> -->

<!-- 
							<br/>

							<div class="row">
								<div class="col-lg-12 text-center">
									<div id="success"></div>
									<input type="submit" name="submit-data"value="submit" class="btn"style="font-size: 18px; height:50px; width:100px;">
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</section> -->
		<p id="back-top">
			<a href="#top"><i class="fa fa-angle-up"></i></a>
		</p>
		<footer>
			<div class="container text-center">
				<p>Next time you think of beautiful things, don't forget to include yourself in!</a></p>
			</div>
		</footer>

		<!-- Modal for portfolio item 1 -->
		<div class="modal fade" id="Modal-1" tabindex="-1" role="dialog" aria-labelledby="Modal-label-1">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="Modal-label-1">Sunglasses & Spectacles</h4>
					</div>
					<div class="modal-body">

<!-- 						<img src="images/glasses/sunglasses1.png" alt="img01" class="img-responsive" /> -->
						<!-- Slideshow container -->
<div class="row">
	<div class="col-md-6">
		<div class="slideshow-container">

		  <!-- Full-width images with number and caption text -->
		  <div class="mySlides">
		    <div class="numbertext">1 / 3</div>
		    <img src="images/glasses/h.png" style="width:100%">
		  </div>

		  <div class="mySlides">
		    <div class="numbertext">2 / 3</div>
		    <img src="images/glasses/sunglasses.png" style="width:100%">
		  </div>

		  <div class="mySlides">
		    <div class="numbertext">3 / 3</div>
		    <img src="images/glasses/sunglasses1.png" style="width:100%">
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
		</div>
	</div>
	<div class="col-md-6">
		<p id="glass_name"></p>
		<p id="glass_cost"></p>
		<input type="submit" name="try_on_btn" value = "Try On" style="margin-bottom:20px; float:right; margin-right:40px;" class="btn btn-default">
	</div>
</div>

<!-- data for sunglasses -->
<script> 
var slideIndex = 1;
var glass_data = [["Solid Black Glasses", "5.00"], ["Black Sunglasses", "7.00"], ["Night Vision glasses", "20.99"]];

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

  //update content
  document.getElementById("glass_name").innerHTML = "Name: "+glass_data[slideIndex - 1][0];
  document.getElementById("glass_cost").innerHTML = "Cost: "+glass_data[slideIndex - 1][1];
}

</script>

<img src="images/developers/samuel.jpg" class="col-md-12"/>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>




		<!-- Modal for portfolio item 2 -->
		<div class="modal fade" id="Modal-2" tabindex="-1" role="dialog" aria-labelledby="Modal-label-2">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="Modal-label-2">Lipsticks</h4>
					</div>
					<div class="modal-body">



<div class="row">
	<div class="col-md-6">
		<div class="slideshow-container">

		  <!-- Full-width images with number and caption text -->
		  <div class="mySlidesLipStick">
		    <div class="numbertext">1 / 4</div>
		    <img src="images/lipstick/0.png" style="width:100%">
		  </div>

		  <div class="mySlidesLipStick">
		    <div class="numbertext">2 / 4</div>
		    <img src="images/lipstick/2.png" style="width:100%">
		  </div>

		  <div class="mySlidesLipStick">
		    <div class="numbertext">3 / 4</div>
		    <img src="images/lipstick/3.png" style="width:100%">
		  </div>

		  <div class="mySlidesLipStick">
		    <div class="numbertext">3 / 4</div>
		    <img src="images/lipstick/4.png" style="width:100%">
		  </div>

		  <!-- Next and previous buttons -->
		  <a class="prev" onclick="plusSlidesLipStick(-1)">&#10094;</a>
		  <a class="next" onclick="plusSlidesLipStick(1)">&#10095;</a>
		</div>
		<br>

		<!-- The dots/circles -->
		<div style="text-align:center">
		  <span class="dotLipStick" onclick="currentSlideLipStick(1)"></span> 
		  <span class="dotLipStick" onclick="currentSlideLipStick(2)"></span> 
		  <span class="dotLipStick" onclick="currentSlideLipStick(3)"></span> 
		  <span class="dotLipStick" onclick="currentSlideLipStick(4)"></span> 
		</div>
	</div>
	<div class="col-md-6">
		<p id="lipstick_name"></p>
		<p id="lipstick_cost"></p>
		<input type="submit" name="try_on_btn" value = "Try On" style="margin-bottom:20px; float:right; margin-right:40px;" class="btn btn-default">
	</div>
</div>

<!-- data for sunglasses -->
<script> 
var slideIndex = 1;
var lipstick_data = [["Solid Black Glasses", "5.00"], ["Black Sunglasses", "7.00"], ["Night Vision glasses", "20.99"], ["Sexy lipsticks", "Very expensive"]];

showSlidesLipStick(slideIndex);

// Next/previous controls
function plusSlidesLipStick(n) {
  showSlidesLipStick(slideIndex += n);
}

// Thumbnail image controls
function currentSlideLipStick(n) {
  showSlidesLipStick(slideIndex = n);
}


function showSlidesLipStick(n) {
  var i;
  var slides = document.getElementsByClassName("mySlidesLipStick");
  var dots = document.getElementsByClassName("dotLipStick");
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

  //update content
  document.getElementById("lipstick_name").innerHTML = "Name: "+lipstick_data[slideIndex - 1][0];
  document.getElementById("lipstick_cost").innerHTML = "Cost: "+lipstick_data[slideIndex - 1][1];
}

</script>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal for portfolio item 3 -->
		<div class="modal fade" id="Modal-3" tabindex="-1" role="dialog" aria-labelledby="Modal-label-3">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="Modal-label-3">Dresses</h4>
					</div>
					<div class="modal-body">


<div class="row">
	<div class="col-md-6">
		<div class="slideshow-container">

		  <!-- Full-width images with number and caption text -->
		  <div class="mySlidesDress">
		    <div class="numbertext">1 / 5<div>
		    <img src="images/dress/1.png" style="width:100%">
		  </div>

		  <div class="mySlidesDress">
		    <div class="numbertext">2 / 5</div>
		    <img src="images/dress/2.png" style="width:100%">
		  </div>

		  <div class="mySlidesDress">
		    <div class="numbertext">3 / 5</div>
		    <img src="images/dress/3.png" style="width:100%">
		  </div>

		  <div class="mySlidesDress">
		    <div class="numbertext">4 / 5</div>
		    <img src="images/dress/4.png" style="width:100%">
		  </div>

		  <div class="mySlidesDress">
		    <div class="numbertext">5 / 5</div>
		    <img src="images/dress/5.png" style="width:100%">
		  </div>

		  <!-- Next and previous buttons -->
		  <a class="prev" onclick="plusSlidesDress(-1)">&#10094;</a>
		  <a class="next" onclick="plusSlidesDress(1)">&#10095;</a>
		</div>
		<br>

		<!-- The dots/circles -->
		<div style="text-align:center">
		  <span class="dotDress" onclick="currentSlideDress(1)"></span> 
		  <span class="dotDress" onclick="currentSlideDress(2)"></span> 
		  <span class="dotDress" onclick="currentSlideDress(3)"></span> 
		  <span class="dotDress" onclick="currentSlideDress(4)"></span>
		  <span class="dotDress" onclick="currentSlideDress(5)"></span> 
		</div>
	</div>
	<div class="col-md-6">
		<p id="dress_name"></p>
		<p id="dress_cost"></p>
		<input type="submit" name="try_on_btn" value = "Try On" style="margin-bottom:20px; float:right; margin-right:40px;" class="btn btn-default">
	</div>

</div>

<!-- data for sunglasses -->
<script> 
var slideIndex = 1;
var dress_data = [["Solid Black Glasses", "5.00"], ["Black Sunglasses", "7.00"], ["Night Vision glasses", "20.99"], ["Sexy lipsticks", "Very expensive"], ['nice dress', 'Extremely Pricey']];

showSlidesDress(slideIndex);

// Next/previous controls
function plusSlidesDress(n) {
  showSlidesLipStick(slideIndex += n);
}

// Thumbnail image controls
function currentSlideDress(n) {
  showSlidesLipStick(slideIndex = n);
}


function showSlidesDress(n) {
  var i;
  var slides = document.getElementsByClassName("mySlidesDress");
  var dots = document.getElementsByClassName("dotDress");
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

  //update content
  document.getElementById("dress_name").innerHTML = "Name: "+dress_data[slideIndex - 1][0];
  document.getElementById("dress_cost").innerHTML = "Cost: "+dress_data[slideIndex - 1][1];
}

</script>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal for portfolio item 4 -->
		<div class="modal fade" id="Modal-4" tabindex="-1" role="dialog" aria-labelledby="Modal-label-4">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="Modal-label-4">Smart Name</h4>
					</div>
					<div class="modal-body">
						<img src="images/demo/portfolio-4.jpg" alt="img01" class="img-responsive" />
						<div class="modal-works"><span>Branding</span><span>Web Design</span></div>
						<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal for portfolio item 5 -->
		<div class="modal fade" id="Modal-5" tabindex="-1" role="dialog" aria-labelledby="Modal-label-5">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="Modal-label-5">Fast People</h4>
					</div>
					<div class="modal-body">
						<img src="images/demo/portfolio-5.jpg" alt="img01" class="img-responsive" />
						<div class="modal-works"><span>Branding</span><span>Web Design</span></div>
						<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

<!-- 		<div class="bg-new-modal" id="bg-new-modal-id">
			<div class="modal-new-content">
				<div class="modal-new-close">+</div>
				<img src="" alt=""/>
			</div>

		</div>

		<script type="text/JavaScript">
			document.getElementById("try_on_btn").addEventListener("click", function(){
				document.getElementById("bg-new-modal-id").style.display="flex";
			});

			document.querySelector(".modal-new-close").addEventListener("click", function(){
				document.querySelector(".bg-new-modal").style.display="none";
			});
		</script> -->

		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/JavaScript">
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

function onFileSelected2(event) {
  var selectedFile = event.target.files[0];
  var reader = new FileReader();

  var imgtag = document.getElementById("myimage2");
  imgtag.title = selectedFile.name;

  reader.onload = function(event) {
    imgtag.src = event.target.result;
  };

  reader.readAsDataURL(selectedFile);
}

function onFileSelected3(event) {
  var selectedFile = event.target.files[0];
  var reader = new FileReader();

  var imgtag = document.getElementById("myimage3");
  imgtag.title = selectedFile.name;

  reader.onload = function(event) {
    imgtag.src = event.target.result;
  };

  reader.readAsDataURL(selectedFile);
}


		</script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/SmoothScroll.js"></script>
		<script src="js/theme-scripts.js"></script>
	</body>
</html>
