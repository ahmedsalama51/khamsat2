<!DOCTYPE HTML>
<html>
<head>
<title>KHAMSAT</title>
<link rel="icon" href="{{ asset('images/icon.png')}}">
<link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Voguish Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="publiclication/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'> -->
<script src="{{ asset('js/jquery-1.12.3.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>

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
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            @if (Auth::user()->isAdmin())
                                <li><a href="/admin">Controle Panal</a></li>
                            @endif
                            @if (Auth::user()->section != Null)
                                <li><a href="/posts/add">Add Post</a></li>
                            @endif
                            
                            <li><a href="/users/{{ Auth::user()->id }}" > <img width="30px" height="20px" src="{{ Auth::user()->image }}" alt=""> {{ Auth::user()->name }} </a>
                            <!-- {{ Auth::user()->name }} -->
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                               
                        @endif
                            
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
				<h4>Latest Posts</h4>
				<ul>
                @foreach ($posts as $post)
                <li><a href="/posts/{{$post->id}}/{{$post->title}}">||   {{$post->title}}</a></li>

                @endforeach
			
				</ul>
			</div>
			<div class="col-md-3 foot-1">
				<h4>Top viewed</h4>
				<ul>
					@foreach ($topviewd as $post)
                <li><a href="/posts/{{$post->id}}/{{$post->title}}">||   {{$post->title}}</a></li>

                @endforeach
				</ul>
			</div>
			<div class="col-md-3 foot-1">
				<h4>Categories</h4>
				<ul>
                @foreach ($categories as $cat)
					<li><a href="/categories/{{$cat->id}}">||  {{$cat->category}}</a></li>
				@endforeach
                </ul>
			</div>
			<div class="col-md-3 foot-1">
				<h4>Tags</h4>
				<ul> 
                @foreach ($tags as $tag)
                    <li><a href="/tags/{{$tag->id}}">||  {{$tag->tag}}</a></li>
                @endforeach
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