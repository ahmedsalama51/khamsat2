<!DOCTYPE HTML>
<html>
<head>
<title>KHAMSAT</title>
<link rel="icon" href="images/icon.png">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Voguish Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'> -->
<script src="js/jquery.min.js"></script>
<script src="js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
	
  </script>
	
</head>
<body>
<!-- header -->
	<div class="header">
		<div class="container">
			<div class="logo">
				<a href="/"><img src="images/logo.png" class="img-responsive" alt=""></a>
			</div>
			
				<div class="head-nav">
					<span class="menu"> </span>
						<ul class="cl-effect-1">
							<li><a href="/">Home</a></li>
							<li><a href="/about">About Us</a></li>
							<li><a href="/category">Category</a></li>
							<li><a href="/tags">Tags</a></li>
							<li><a href="/login">Login</a></li>
							<li><a href="/register">Rigster</a></li>
										<div class="clearfix"></div>
						</ul>
				</div>
						<!-- script-for-nav -->
							<script>
								$( "span.menu" ).click(function() {
								  $( ".head-nav ul" ).slideToggle(300, function() {
									// Animation complete.
								  });
								});
							</script>
						<!-- script-for-nav -->
				
						
			
					<div class="clearfix"> </div>
		</div>
	</div>
<!-- header -->
	@yield('content')
<!-- footer sector -->
		<div class="footer">
			<div class="col-md-3 foot-1">
				<h4>Quick Links</h4>
				<ul>
					<li><a href="#">||   Lorem Ipsum passage</a></li>
					<li><a href="#">||   Finibus Bonorum et</a></li>
					<li><a href="#">||   Treatise on the theory</a></li>
				</ul>
			</div>
			<div class="col-md-3 foot-1">
				<h4>Favorite Resources</h4>
				<ul>
					<li><a href="#">||   Characteristic words</a></li>
					<li><a href="#">||   combined with a handful</a></li>
					<li><a href="#">||   which looks reasonable</a></li>
				</ul>
			</div>
			<div class="col-md-3 foot-1">
				<h4>About Us</h4>
				<ul>
					<li><a href="#">||  Even slightly believable</a></li>
					<li><a href="#">||  Hidden in the middle</a></li>
					<li><a href="#">||  Ipsum therefore always</a></li>
				</ul>
			</div>
			<div class="col-md-3 foot-1">
				<h4>Custom Menu</h4>
				<ul>
					<li><a href="#">||  Internet tend to repeat</a></li>
					<li><a href="#">||  Alteration in some form</a></li>
					<li><a href="#">||  This book is a treatise</a></li>
				</ul>
			</div>
			
			<div class="clearfix"> </div>
			<div class="copyright">
				<p>Copyrights © 2016 ITI All rights reserved | Template by <a href="http://facebook.com/AhmedSalama51/">Ahmed Salama</a></p>
			</div>
		</div>
	</div>
</body>
</html>