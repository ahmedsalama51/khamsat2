@extends('layout')
  @section('content')
  <!-- header -->
 	<div class="container">
 		<div class="about">
 			<h2>About</h2>
 			<div class="about-top">
 				 <div class="col-md-6 ab-top">
 				 	<img src="{{ asset('images/ban.jpg')}}" class="img-responsive" alt="">
 				 </div>
 				 <div class="col-md-6 ab-top">
 				 	<h3>Khamsat blog fot the latest news and most hot disscusion topics</h3>
 				 	<p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. of Lorem Ipsum. PageMaker including versions of Lorem Ipsum.</p>
 					<p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions Letraset sheets containing Lorem Ipsum passages, and more recently with including versions of Lorem Ipsum.</p>
 				 </div>
 				 	<div class="clearfix"> </div>
 			</div>
		<div class="team_grid">
       		<h3 class="m_1">Meet Our Team</h3>
       	  
       	  @foreach ($users as $user)
       	   <div class="col-md-6 ab-top" style="margin-top:5px;">
       	  	<ul class="span_2">
       	  		<li class="span_2-left"><img src="{{ $user->image}}" class="img-responsive" alt=""></li>
       	  		<li class="span_2-right">
       	  		  <a href="/users/{{$user->id}}">
                  <h3>{{$user-> name}}</h3>
                </a>
       	  		 
       	  		  <p>{{$user-> email}}</p>
       	  		  
       	  		</li>
       	  		<div class="clearfix"> </div>
       	  	</ul>
       	   </div>
       	   
       	  
        @endforeach
        <div class="clearfix"> </div>
  </div>
     <!-- <div class="testimonial">
     	
     		<h3>Our Testimonials</h3>
     		<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum</p>
     	    <ul class="test_icon">
     	    	<li><a href="#"><img src="{{ asset('images/1.jpg')}}" class="img-responsive"></a></li>
     	    	<li><a href="#"><img src="{{ asset('images/2.jpg')}}" class="img-responsive"></a></li>
     	    	<li><a href="#"><img src="{{ asset('images/3.jpg')}}" class="img-responsive"></a></li>
     	    	<li><a href="#"><img src="{{ asset('images/4.jpg')}}" class="img-responsive"></a></li>
     	    	<li><a href="#"><img src="{{ asset('images/5.jpg')}}" class="img-responsive"></a></li>
     	    	<div class="clearfix"> </div>
     	    </ul>
     	
     </div> -->
</div>
@stop