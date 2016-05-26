@extends('layout')
  @section('content')
  <!-- header -->
  <script stype="text/javascript" charset="utf-8" async defer>
  $(function () {
  	$('#error').fadeIn('slow').delay(2000).fadeOut('slow');
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
		  	  <form class="form-horizontal" role="form" method="POST" action="/edit/{{$post->id}}" enctype="multipart/form-data">
		  	  		<input name="_method" type="hidden" value="PUT">
                    {!! csrf_field() !!}
				 	<div class="register-top-grid ">
					<h3>ADD NEW POST</h3>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						<span>Title<label>*</label></span>
						<input type="text" placeholder="post title..." name="title" required value="{{$post->title}}"> 
					 </div>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						<span>Description<label>* </label></span>
						<input type="text" placeholder="must be less than 100 letter" name="description" required value="{{$post->description}}"> 
					 </div>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						<span>Content<label>*</label></span>
						<textarea name="content" placeholder="post content..." required >{{$post->content}}</textarea>
					 </div>
					 
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						<span>Tags ~ <label style="color:black"> Old Tags :</label> 
							@if(isset($post_tags))
								@foreach ($post_tags as $tag) 
									<a href="/tags/{{$tag->id}}">#{{$tag->tag}}</a>
								@endforeach
							@endif
						</span>
						<input type="text" placeholder="post tags..." name="tags" required > 
					 </div>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						 <span>Published Date ~ <label style="color:black"> Old : {{$post->posted_date}}</span>
						 <input type="datetime-local" required  name="posted_date"> 
					 </div>
					 <div class="wow fadeInLeft col-md-12" data-wow-delay="0.4s">
						 <span>Post Image<label>*</label></span>
						 <input type="file" required  name="image"><br> <img src="{{$post->image}}" alt="" width="50" height="40">
					 </div>
				</div>
					 <div class="clearfix"> </div>
					 <input class="btn btn-primary" type="submit" value="Update">
					   
				   </form>
				</div>
		   </div>
	</div>
<!-- registration -->
@stop