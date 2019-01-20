<!DOCTYPE html>
<html>
<head>
	<title>Spectacles</title>
			<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<meta name="robots" content="noindex,follow" />
</head>
<body>

	<div class="row">
		<div class="col-lg-4 text-center">
			<img src="{{ picture }}" alt="User Image">

		</div>
		<div class="col-lg-4 text-center">
			<img src="{{ glasses }}" alt="User Image">
			
		</div>
			<!-- <main class="container"> -->
		<div class="col-lg-4 text-left">
			        <!-- Product Description -->
        <div class="product-description">
                  <h1 style="font-weight:300; font-size:52px; color:#43484D; letter-spacing: -2px">Sunglasses & Spectacles</h1>
          <p style="font-size:16px; font-weight:300; color:#86939E; line-height:24px;">The preferred choice of a vast range of acclaimed DJs. Punchy, bass-focused sound and high isolation. Sturdy headband and on-ear cushions suitable for live performance</p>
        </div>
        <hr/>
        <!-- Product Configuration -->
        <div class="product-configuration">
        <!-- Product Pricing -->
        <div class="product-price row">
          <span class="col-lg-2" style="font-size:26px; margin-top:20px; font-weight:300; color:#43474D; margin-right:20px;">$50</span>
          <!-- <a href="#" class="cart-btn">Next</a> -->
          <br/>
	<form action = "http://127.0.0.1:5000/put_glasses" method = "POST">
   <p>User id <input type = "text" name = "user_id"  value = {{ user_ids }}></p>
<input type="text" name="product_id" value = {{ cat }} >
<input type="submit" class="btn btn-success col-lg-2" value="Next" style="margin-left:-20px; float:left;"/> 
  </form>
          
                    <input type="submit" name="home_glasses_product" class="btn btn-success col-lg-2" value="Home" style="margin-left:20px;float:left;"/> 
        </div>
      </div>
			</div>
		
	</div>
<!-- </main> -->
</body>
</html>
