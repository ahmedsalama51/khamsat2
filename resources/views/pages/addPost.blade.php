@extends('layout')
  @section('content')
  <!-- header -->
  <script stype="text/javascript" charset="utf-8" async defer>
  $(function () {
  	$('#error').fadeIn('slow').delay(2000).fadeOut('slow');
  	$('#validation').fadeIn('slow').delay(5000).fadeOut('slow');
  });
  </script>
<div class="container">
	<div class="main-1">
		
			<div class="register">
			@if(Session::has('error'))
				<div class='alert alert-success' id='error'>
					{{session('error')}}
					{{Session::forget('error')}}
				</div>
			@elseif(isset($massage))
				<div class='alert alert-error' id='error'>
					{{$massage}}

				</div>

			@endif
		  	  <form class="form-horizontal" role="form" method="POST" action="/posts/add" enctype="multipart/form-data">

                    {!! csrf_field() !!}
				 	<div class="register-top-grid ">
					<h3>ADD NEW POST</h3>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						<span>Title<label>*</label></span>
						<input type="text" placeholder="post title..." name="title" value={{old("title")}} > 
					 </div>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						<span>Description<label>* </label></span>
						<input type="text" placeholder="must be less than 100 letter" name="description" value={{old('description')}} > 
					 </div>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						<span>Content<label>*</label></span>
						<textarea name="content" placeholder="post content..." >{{old('content')}}</textarea>
					 </div>
					 
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						<span>Tags<label></label></span>
						<input type="text" placeholder="post tags..." name="tags" value={{old('tags')}} > 
					 </div>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						 <span>Published Date<label>*</label></span>
						 <input type="datetime-local"  name="posted_date"> 
					 </div>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						 <span>Post Image<label>*</label></span>
						 <input type="file"  name="image"> 
					 </div>
				</div>
					 <div class="clearfix"> </div>
					 <input class="btn btn-primary" type="submit" value="submit">
					   
				   </form>
				</div>
				@if (count($errors) > 0)
				<div class="alert alert-danger" id="validation" style="margin:10px">
					<ul>
						@foreach($errors->all() as $error)
						<li>
							{{ $error}}
						</li>
						@endforeach
					</ul>
					</div>
				@endif
		   </div>
	</div>
<!-- registration -->
@stop
