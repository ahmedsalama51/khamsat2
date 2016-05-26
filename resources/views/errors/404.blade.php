<!DOCTYPE HTML>
<html>
<head>
<title>KHAMSAT</title>
<link rel="icon" href="{{ asset('images/icon.png')}}">
<link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Voguish Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="publiclication/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'> -->
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/responsiveslides.min.js')}}"></script>
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
<div class="header">
        <div class="container">
            <div class="logo">
                <a href="/"><img src="{{ asset('images/logo.png')}}" class="img-responsive" alt=""></a>
            </div>
            
                <div class="head-nav">
                    <span class="menu"> </span>
                        <ul class="cl-effect-1">
                            <li><a href="/">Home</a></li>
                            <li><a href="/about">About Us</a></li>
                       
                            
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

<!-- 404 -->
<div class="container">
	<div class="main">
		<div class="error-404 text-center">
				<h1>404</h1>
				<p>this link dead link</p>
                @if(isset($e) || isset($request))
                    {{$e}}
                @endif
                @if(isset($errors) && count($errors) > 0)
                <div class="alert alert-danger" id="validation" style="margin:10px">
                   {{ $errors}}
                       
                    </div>
                @endif
				<a class="b-home" href="/">Back to Home</a>
			</div>
	</div>
	<!-- 404 -->

