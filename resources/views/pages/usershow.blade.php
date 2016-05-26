@extends('layout')
  @section('content')
  <!-- header -->
 	<div class="container">
 		<div class="about">
 			<h2>About MR : <span style="color:#F9B01C">{{$user->name}}</span></h2>
 			<div class="about-top">
 				 <div class="col-md-5 ab-top">
 				 	<img src="{{ $user->image}}" class="img-responsive col-md-6" alt="">
         @if(isset(Auth::user()->id) && Auth::user()->id == $user->id)
              <a href="/user/edit/{{$user->id}}">  <span style="color:#F53F1A;" class='glyphicon glyphicon-edit'></span style="color:#26313b;"> Edit</a>
              <a href="/user/deactive/{{$user->id}}">  <span style="color:#F53F1A;" class="glyphicon glyphicon-trash"></span> Deactive</a>
            @endif
        </div>
 				 <div class="col-md-6 ab-top">
 				 	<h3>Name </h3>
 				 	 <p>
           {{$user->name}}
           
            </p>
          <h3>Email </h3>
            <p>{{$user->email}}</p>
          <h3>Section </h3>
            <a href="/categories/{{$category->id}}">
              <p>{{$category->category}}</p>
            </a>
 				 </div>
 				 	<div class="clearfix"> </div>
 			</div>
		<div class="team_grid">
       		<h3 class="m_1">His Latest Works :</h3>
       	  <div class="span_3">
       	   @foreach ($posts as $post)
       	   <div class="col-md-6 ab-top" style="margin-top:10px">
       	  	<ul class="span_2">
       	  		<li class="span_2-left"><img style="max-height:150px;" src="{{ $post-> image}}" class="img-responsive" alt=""></li>
       	  		<li class="span_2-right">
       	  		  <a href="/posts/{{ $post->id }}/{{ $post->title }}">
                  <h3>{{ $post-> title}}</h3>
                </a>
       	  		 
       	  		  <p>{{ $post-> description}}</p>
       	  		  
       	  		</li>
       	  		<div class="clearfix"> </div>
       	  	</ul>
       	   </div>
       	   
           @endforeach
           <div class="clearfix"> </div>
       	  </div>
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