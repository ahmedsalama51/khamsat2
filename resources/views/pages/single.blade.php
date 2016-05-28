@extends('layout')
	@section('content')
	<!-- header -->
<!-- content -->
<div class="container">
<div class="content-top">
	
			<div class="single">
				<div class="single-top">

					<img src="{{$post->image}}"  alt="" width="300px" height="400px">
					<h1 style="color:#F9B01C"><br>{{$post->title}}</h1>
					<p class="sin">{{$post->content}}</p>
					
						<div class="artical-links">
		  						 	<ul>
		  						 		<li><small> </small><span>{{$post->posted_date}}</span></li>
		  						 		<li><a href="/users/{{$post->user_id}}"><small class="admin"> </small><span>{{$user->name}}</span></a></li>
		  						 		<li></li>
		  						 		<li><small class="posts"> </small><span>({{$post->views_num}}) views</span></li>
		  						 		<li><a href="/categories/{{$category->id}}"><small class="link"> </small><span>{{$category->category}} </span></a></li>
		  						 		@if($permission > 0)
		  						 			<li><a href="/edit/{{$post->id}}"><span style="color:#F53F1A;" class='glyphicon glyphicon-edit'></span style="color:#26313b;"> Edit</a></li>
		  						 			<li><a href="/delete/{{$post->id}}"><span style="color:#F53F1A;" class="glyphicon glyphicon-trash"></span> Delete</a></li>
		  						 		@endif
		  						 	</ul>
		  						 </div>
						<div class="respon">
							<h2><i class="fa fa-comments" aria-hidden="true"></i> Our Readeres comments :</h2>
							@if(sizeof($comments) > 0)
								@foreach ($comments as $comment) 
								<div class="strator">
									<div class="strator-left">
										<h5 style=" color:#F9B01C;">{{$comment->user->name}}</h5>
										<img src="{{$comment->user->image}}" class="img-responsive" alt="">
										<p>{{$comment->created_at}}</p>
									</div>
									<div class="strator-right">
										@if($comment->user_id == Auth::user()->id)
										<a  data-toggle="modal" data-target=".comment-{{$comment->id}}" class="pull-right edit" style="margin:2px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
										<div class="modal fade comment-{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title" id="gridSystemModalLabel">Edit comment</h4>
										      </div>
										      <div class="modal-body">
										        <div class="form-group">
										            <label for="recipient-name" class="control-label">Comment:</label>
										            <input type="hidden" class="token" value="{{ csrf_token() }}">
												 	<textarea name="content" class="form-control edit_comment_content" article="{{$post->id}}" comment="{{$comment->id}}" placeholder="Leave your comment">{{$comment->content}} </textarea>
										         </div>   
										       </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										        <button type="button" class="btn btn-primary edit_comment" data-dismiss="modal">Save changes</button>
										      </div>
										    </div><!-- /.modal-content -->
										  </div><!-- /.modal-dialog -->
										</div><!-- /.modal -->

										<a href="" class="pull-right delete" style="color:red;margin:2px"><i class="fa fa-trash pull-right" aria-hidden="true"></i></a>
										@endif
										<p class="sin">{{$comment->content}}.</p>
									</div>
									<div class="clearfix"></div>
									<!--<div class="rep">
										<a  href="" class="reply">REPLY</a>
									</div>
									<div class="comment hide">
										<h2>Replay on comment</h2>
										<form method="post" action="">
										 <textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
										 <textarea class="comment_content" article="{{$post->id}}" comment="{{$comment->id}}" value="{{old('content')}}" placeholder="Leave your reply comment"></textarea>
										 <div class="smt1">
											<input type="submit" class="add_comment" value="add a reply">
										 </div>
									   </form>
									</div> -->
								</div>
								<hr>
								@endforeach
							@else
							<p> -- no Comments yet --</p>
							@endif

							<!-- <div class="strator1">
								<h5>JANE DOE</h5>
								<p>feb 20th, 2015 at 9:41 pm</p>
									<div class="strator-left">
										<img src="{{asset('images/co.png')}}" class="img-responsive" alt="">
									</div>
									<div class="strator-right">
										<p class="sin">Sed posuere consectetur est at lobortis. Nulla vitae elit libero, a pti
											metus auctor fringilla. Donec id elit non mi porta  da at eget me  us,
											ortor mauris ntum nibh, ut fermentum massa risus. Sed posuere 
											Nulla vitae elit liber. Sed posuere consectetur.</p>
									</div>
								<div class="clearfix"></div>
								<div class="rep">
									<a href="#" class="reply">REPLY</a>
								</div>
							</div> -->
						</div>
					</div>
					<div class="blog-content-right">
						<div class="b-search">
							<form action="/search" method="POST">
							{!! csrf_field() !!}
								<input name="searchinput" type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
								<input type="submit" value="">
							</form>
						</div>
						@if(isset($post_tags))
						<div class="b-tag-weight">
							<h3>Post Tags</h3>
							<ul>
							@foreach ($post_tags as $tag) 
								<li><a href="/tags/{{$tag->id}}">{{$tag->tag}}</a></li>
							@endforeach
							</ul>
						</div>
						@endif
						<!-- //End-tag-weight---->
					</div>
					@if(Auth::user() && Auth::user()->is_active == 1)
					<div class="comment col-md-8">
						<h2>Leave a comment</h2>
						<!-- <form action="/comments/add/{{$post->id}}" method="POST">
						{!! csrf_field() !!} -->
						 <!-- <textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea> -->
						 <input type="hidden" class="token" value="{{ csrf_token() }}">
						 <textarea name="content" value="{{old('content')}}" class="comment_content" article="{{$post->id}}" placeholder="Leave your comment"></textarea>
						 <div class="smt1">
							<input type="submit" value="add a comment" class="add_comment">
						 </div>
						<!-- </form> -->
					</div>
					@endif
						
				
				
					<div class="clearfix"> </div>
			</div>
</div>
	@stop

	<script src="{{ asset('js/jquery-1.12.3.js')}}"></script>
	<script>
	$(function() {
		$('.reply').on('click', function(event) {
			event.preventDefault();
			/* Act on the event */
			$(this).addClass('hide');
			$(this).parent().parent().find('.comment').removeClass('hide').show('slow')
		});
		$('.add_comment').on('click', function(event) {
			event.preventDefault();
			/* Act on the event */
			var post = $(this).parent().parent().find('.comment_content').attr('article'); 
			var comment_Url = '/comments/add/'+post;
			var token = $(this).parent().parent().find('.token').val()
			var formData = {
				'_token': token,
				'post_id':post,
	            'content': $(this).parent().parent().find('.comment_content').val(),
	        }
			$.ajax({
				url: comment_Url,
				type: 'post',
				data: formData,
				success:function(response){
					if(response == 'error')
					{
						$('.respon').append('<div class="alert alert-danger"> Please enter comment with min length 6 letters</div>')
						$('.alert').delay(5000).fadeOut('slow');
					}
					else
					{
						// $('.add_comment').parent().parent().find('.comment_content').val('')
						console.log(response);
						comment = response['comment'];
						user = response['user'];
						// $('.respon').html('');
						// $('.respon').append('<h2><i class="fa fa-comments" aria-hidden="true"></i> Our Readeres comments :</h2>');
							// $.each(response, function(index, comment) {
						$('.respon').append('<div class="strator"><div class="strator-left"><h5 style=" color:#F9B01C;">'+user['name']+'</h5><img src="'+user['image']+'" class="img-responsive" alt=""><p>'+comment['created_at']+'</p></div><div class="strator-right"><p class="sin">'+comment['content']+'.</p></div><div class="clearfix"></div></div>');
						$('.respon').append('</br>');
							// });
					}
					
				},
				error:function(response){
					console.log(response);
				}
			})//end of ajax action
		});//end of comment submit
		$('.edit_comment').on('click', function(event) {
			event.preventDefault();
			/* Act on the event */
			var post = $(this).parent().parent().find('.edit_comment_content').attr('article'); 
			var comment = $(this).parent().parent().find('.edit_comment_content').attr('comment'); 
			var comment_Url = '/comment/edit/'+post+'/'+comment;
			var token = $(this).parent().parent().find('.token').val()
			var formData = {
				'_token': token,
				'post_id':post,
	            'content': $(this).parent().parent().find('.edit_comment_content').val(),
	        }
			$.ajax({
				url: comment_Url,
				type: 'post',
				data: formData,
				success:function(response){
					if(response == 'error')
					{
						$('.respon').append('<div class="alert alert-danger"> Please enter comment with min length 6 letters</div>')
						$('.alert').delay(5000).fadeOut('slow');
					}
					else
					{
						window.location.reload(true)
						
					}
				},
				error:function(response){
					console.log(response);
				}
			})//end of ajax action
		});//end of comment submit
	});//end of load JQ function

	</script>
