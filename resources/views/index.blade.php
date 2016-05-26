
@extends('layout')
	@section('content')
	<!-- header -->
	<style type="text/css" media="screen">
		.slideImg{
			min-height: 400px;
			max-height: 400px;
		}	
	</style>
	<div class="container">
		<div class="col-md-9 bann-right">
			<!-- banner -->
			<div class="banner">		
				<div class="header-slider">
					<div class="slider">
						<div class="callbacks_container">
						  	<ul class="rslides" id="slider">
								@foreach ($slideposts as $post)
								<li>
									<img  src="{{ $post->image }}" class="img-responsive slideImg" alt="" height="300px">
									<div class="caption">
										<a href="posts/{{ $post->id }}/{{ $post->title }}">
											<h3>{{ $post->title }}</h3>
										</a>
										<p>{{ $post->description }}</p>
									</div>
								</li>
								@endforeach
								
							</ul>
				  		</div>
					 </div>
				</div>
			</div>
			<!-- banner -->	
			<!-- nam-matis -->
			<div class="nam-matis">
			
				<div class="nam-matis-top">
				@foreach ($recent2posts as $post)
							<div class="col-md-6 nam-matis-1">
								<a href="single.html"><img src="{{ $post->image }}" class="img-responsive" alt=""></a>
								<h3><a href="/posts/{{ $post->id }}/{{ $post->title }}">{{ $post->title }}</a></h3>
								<p>{{ $post->description }}</p>
							</div>
							
								
				@endforeach
				<div class="clearfix"> </div>
				</div>
				<div class="nam-matis-top">
				@foreach ($recent4posts as $post)
							<div class="col-md-6 nam-matis-1">
								<a href="single.html"><img  src="{{ $post->image }}" class="img-responsive" alt=""></a>
								<h3><a href="/posts/{{ $post->id }}/{{ $post->title }}">{{ $post->title }}</a></h3>
								<p>{{ $post->description }}</p>
							</div>
				@endforeach
				<div class="clearfix"> </div>
				</div>
			
			</div>
			<!-- nam-matis -->	
		</div>
		<div class="col-md-3 bann-left">
			<div class="b-search">
				<form action="/search" method="POST">
				{!! csrf_field() !!}
					<input name="searchinput" type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
					<input type="submit" value="">
				</form>
			</div>
			<h3>Recent Posts</h3>
			<div class="blo-top">

			@foreach ($posts as $post)
				<div class="blog-grids">
					<div class="blog-grid-left">
						<a href="single.html"><img src="{{ $post->image }}" class="img-responsive" alt=""></a>
					</div>
					<div class="blog-grid-right">
						<h4><a href="posts/{{ $post->id }}/{{ $post->title }}">{{ $post->title }} </a></h4>
						<p>{{ $post->description }} </p>
					</div>
					<div class="clearfix"> </div>
				</div>
			@endforeach
				
			</div>
			<h3>Top Viewd Posts</h3>
			<div class="blo-top">

			@foreach ($topviewd as $post)
				<div class="blog-grids">
					<div class="blog-grid-left">
						<a href="single.html"><img src="{{ $post->image }}" class="img-responsive" alt=""></a>
					</div>
					<div class="blog-grid-right">
						<h4><a href="posts/{{ $post->id }}/{{ $post->title }}">{{ $post->title }} </a></h4>
						<p>{{ $post->description }} </p>
					</div>
					<div class="clearfix"> </div>
				</div>
			@endforeach
				
			</div>
			<h3>Categories</h3>
			<div class="blo-top">
				@foreach ($categories as $category)
				<li><a href="/categories/{{ $category->id }}">||   {{ $category->category }}</a></li>
				@endforeach
			</div>		
			<h3>Tags</h3>
			<div class="blo-top">
				@foreach ($tags as $tag)
				<li><a href="/tags/{{ $tag->id }}">||   {{ $tag->tag }}</a></li>
				@endforeach
			</div>
		</div>
		<div class="clearfix"> </div>
			<!-- <div class="fle-xsel">
				<ul id="flexiselDemo3">
					<li>
						<a href="#">
							<div class="banner-1">
								<img src="images/6.jpg" class="img-responsive" alt="">
							</div>
						</a>
					</li>
					<li>
						<a href="#">
							<div class="banner-1">
								<img src="images/5.jpg" class="img-responsive" alt="">
							</div>
						</a>
					</li>			
					<li>
						<a href="#">
							<div class="banner-1">
								<img src="images/1.jpg" class="img-responsive" alt="">
							</div>
						</a>
					</li>		
					<li>
						<a href="#">
							<div class="banner-1">
								<img src="images/4.jpg" class="img-responsive" alt="">
							</div>
						</a>
					</li>	
					<li>
						<a href="#">
							<div class="banner-1">
								<img src="images/6.jpg" class="img-responsive" alt="">
							</div>
						</a>
					</li>	
					<li>
						<a href="#">
							<div class="banner-1">
								<img src="images/1.jpg" class="img-responsive" alt="">
							</div>
						</a>
					</li>				
				</ul>
								
								 <script type="text/javascript">
									$(window).load(function() {
										
										$("#flexiselDemo3").flexisel({
											visibleItems: 5,
											animationSpeed: 1000,
											autoPlay: true,
											autoPlaySpeed: 3000,    		
											pauseOnHover: true,
											enableResponsiveBreakpoints: true,
											responsiveBreakpoints: { 
												portrait: { 
													changePoint:480,
													visibleItems: 2
												}, 
												landscape: { 
													changePoint:640,
													visibleItems: 3
												},
												tablet: { 
													changePoint:768,
													visibleItems: 3
												}
											}
										});
										
									});
									</script>
									<script type="text/javascript" src="js/jquery.flexisel.js"></script>
						<div class="clearfix"> </div> -->
			</div>
	@stop		