@extends('layout')
  @section('content')
  <!-- header -->
 	<div class="container">
 		<div class="about">
 			
		<div class="team_grid" style="padding-top: 0em;">
          @if(sizeof($resultofpost)>0)
       		<h3 class="m_1">Search Post Result:</h3>
       	  <div class="span_3">
       	   @foreach ($resultofpost as $post)
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
          @endif
         <!-- if there is category search -->
          @if(sizeof($resultofcategory)>0)
          <h3 class="m_1">Search Category Result:</h3>
            <div class="b-tag-weight" style="margin-top:0em;border-top: 1px dotted #000;">
              <ul>
              @foreach ($resultofcategory as $cat) 
                <li><a href="/categories/{{$cat->id}}">{{$cat->category}}</a></li>
              @endforeach
              </ul>
            </div>
           <div class="clearfix"> </div>
          </div>
          @endif
          <!-- if there is tag search -->
           @if(sizeof($resultoftag)>0)
          <h3 class="m_1">Search Tag Result:</h3>
            <div class="b-tag-weight" style="margin-top:0em;border-top: 1px dotted #000;">
              <ul>
              @foreach ($resultoftag as $tag) 
                <li><a href="/tags/{{$tag->id}}">{{$tag->tag}}</a></li>
              @endforeach
              </ul>
            </div>
           <div class="clearfix"> </div>
          </div>
          @endif
          <!-- if there is user search -->
           @if(sizeof($resultofuser)>0)
          <h3 class="m_1">Search Users Result:</h3>
            <div class="b-tag-weight" style="margin-top:0em;border-top: 1px dotted #000;">
              <ul>
              @foreach ($resultofuser as $user) 
                <li><a href="/users/{{$user->id}}">{{$user->name}}</a></li>
              @endforeach
              </ul>
            </div>
           <div class="clearfix"> </div>
          </div>
          @endif
          
     </div>
    
    </div>
@stop