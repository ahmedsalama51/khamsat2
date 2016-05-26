@extends('layout')
  @section('content')
  <!-- header -->
  <div class="container">
    <div class="about">
      
    <div class="team_grid" style="padding-top: 0em;">
            
          <h3 class="m_1">All Posts Of {{ $tag->tag}} :</h3>
          <div class="span_3">
           @foreach ($tagPosts as $post)
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
          <div class="b-tag-weight" style="margin-top:0em;border-top: 1px dotted #000;">
              <h3>Other Tags</h3>
              <ul>
              @foreach ($otherTags as $tag) 
                <li><a href="/tags/{{$tag->id}}">{{$tag->tag}}</a></li>
              @endforeach
              </ul>
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