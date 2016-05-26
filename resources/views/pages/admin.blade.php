@extends('layout')
  @section('content')
  <!-- header -->
    <script stype="text/javascript" charset="utf-8" async defer>
  $(function () {
    $('#error').fadeIn('slow').delay(2000).fadeOut('slow');

    $('#addbtn').on('click', function(event) {
      event.preventDefault();
      $('#addbtn').addClass('hide');
      $('#addform').removeClass('hide');
    });
    $('#submitadd').on('click', function(event) {
      $('#addbtn').removeClass('hide');
      $('#addform').addClass('hide');
    });
  });
  </script>
 	<div class="container">
  @if(Session::has('error'))
        <div style="color:green" class='alert alert-success' id='error'>
          {{session('error')}}
          {{Session::forget('error')}}
        </div>
      @elseif(Session::has('massage'))
        <div style="color:green" class='alert alert-error' id='error'>
          {{session('massage')}}
          {{Session::forget('massage')}}

        </div>

      @endif
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#tab1">Unpublished Posts @if($UnPubposts->count()>0)<span class="badge" style="color:#F9B01C">{{$UnPubposts->count()}}</span>@endif</a></li>
    <li><a data-toggle="tab" href="#tab2">Published Posts @if($Pubposts->count()>0)<span class="badge" style="color:#F9B01C">{{$Pubposts->count()}}</span>@endif</a></li>
    <li><a data-toggle="tab" href="#tab3">Category</a></li>
    <li><a data-toggle="tab" href="#tab4">Users @if($unactiveUsers->count()>0)<span class="badge" style="color:#F9B01C">{{$unactiveUsers->count() }}</span>@endif</a></li>

  </ul>

  <div class="tab-content">
  
    <div id="tab1" class="tab-pane fade in active">
      <!-- <h3>Unpublishe Posts</h3> -->
      <div class="table-responsive">
        <table style="max-height:500px;over-flow:scroll;" class="table table-condensed table-striped table-bordered table-hover " border="1">
          <caption>Unpublished Posts</caption>
          <thead style="background-color: #F9B01C;">
            <tr>
              <th>Title</th>
              <th>Discription</th>
              <th>Author</th>
              <th>Published Date</th>
              <th>Created At</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($UnPubposts as $post)
            <tr>
              <td><a href="posts/{{ $post->id }}/{{ $post->title }}">{{$post->title}}</a></td>
              <td>{{$post->description}}</td>
              <td><a href="/users/{{$post->user_id}}">{{$post->user->name}}</a></td>
              <td>{{$post->posted_date}}</td>
              <td>{{$post->created_at}}</td>
              <td>{{$post->updated_at}}</td>
              <td>
                <form action="/controle/{{$post->id}}" method="get">
                  <div class="btn-group">
                    <input class="btn btn-success" type="submit" name="publish" value="Publish">
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                  </div>
                </form>
                
              </td>

            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      
    </div>
    <div id="tab2" class="tab-pane fade in active">
      <!-- <h3>Unpublishe Posts</h3> -->
      <div class="table-responsive">
        <table style="max-height:500px;over-flow:scroll;" class="table table-condensed table-striped table-bordered table-hover " border="1">
          <caption>Published Posts</caption>
          <thead style="background-color: #F9B01C;">
            <tr>
              <th>Title</th>
              <th>Discription</th>
              <th>Author</th>
              <th>Published Date</th>
              <th>View Count</th>
              <th>Created At</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($Pubposts as $post)
            <tr>
              <td><a href="posts/{{ $post->id }}/{{ $post->title }}">{{$post->title}}</a></td>
              <td>{{$post->description}}</td>
              <td><a href="/users/{{$post->user_id}}">{{$post->user->name}}</a></td>
              <td>{{$post->posted_date}}</td>
              <td>{{$post->views_num}}</td>
              <td>{{$post->created_at}}</td>
              <td>{{$post->updated_at}}</td>
              <td>
                <form action="/controle/{{$post->id}}" method="get">
                  <div class="btn-group">
                    <input class="btn btn-warning" type="submit" name="publish" value="unPublish">
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                  </div>
                </form>
                
              </td>

            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      
    </div>
    <div id="tab3" class="tab-pane fade">
       <div class="table-responsive">
        <table style="max-height:500px;over-flow:scroll;" class="table table-condensed table-striped table-bordered table-hover " border="1">
          <caption>Categories

          <a id="addbtn" class="btn btn-md btn-primary pull-right">Add New</a>
          <form id="addform" action="/category/add" method="GET" class="hide pull-right">
            <div class="btn-group">
              <input class="btn btn-sm" type="text" name="category" placeholder="add new category...">
              <input id="submitadd" class="btn btn-sm btn-success" type="submit" value="submit">
            </div>
          </form>
          </caption>
          <thead style="background-color: #F9B01C;">
            <tr>
              <th>Title</th>
              <th>Posts Count</th>
              <th>users Count</th>
              <th>Created At</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($allcategories as $category)
            <tr>
              <td><a href="/categories/{{ $category->id }}">{{$category->category}}</a></td>
              <td>{{$category->posts->count()}}</td>
              <td>{{$category->users->count()}}</td>
              <td>{{$category->created_at}}</td>
              <td>{{$category->updated_at}}</td>
              <td>
                <form action="/cat/controle/{{$category->id}}" method="get">
                  <div class="btn-group">
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                  </div>
                </form>
                
              </td>

            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      
    </div>
     <div id="tab4" class="tab-pane fade">
       <div class="table-responsive">
        <table style="max-height:500px;over-flow:scroll;" class="table table-condensed table-striped table-bordered table-hover " border="1">
          <caption>New Users</caption>
          <thead style="background-color: #F9B01C;">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Joined at</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($unactiveUsers as $user)
            <tr>
              <td><a href="/users/{{ $user->id }}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
              <td>
                <form action="/user/controle/{{$user->id}}" method="get">
                  <div class="btn-group">
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                    <input class="btn btn-success" type="submit" name="active" value="Active">
                  </div>
                </form>
                
              </td>

            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="table-responsive">
        <table style="max-height:500px;over-flow:scroll;" class="table table-condensed table-striped table-bordered table-hover " border="1">
          <caption>Admins</caption>
          <thead style="background-color: #F9B01C;">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Section</th>
              <th>Posts no.</th>
              <th>Joined at</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($admins as $user)
            <tr>
              <td><a href="/users/{{ $user->id }}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>
              @if(isset($user->category->category))
                <a href="/categories/{{ $user->category->id }}">
                  {{$user->category->category}}
                </a>
              @else
              <form action="/user/controle/{{$user->id}}" method="GET">
                 <div class="btn-group">
                  <select name="section" class="form-control">
                    <option disabled selected>- not selected yet -</option>
                  
                    @foreach ($allcategories as $cat)
                    <option value="{{$cat->id}}">{{$cat->category}}</option>
                    @endforeach
                  </select>
                  <input class="btn btn-sm btn-primary" type="submit" name="cat" value="submit">
                </div>
              </form>
              @endif
              </td>
              <td>{{$user->posts->count()}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
              <td>
                <form action="/user/controle/{{$user->id}}" method="get">
                  <div class="btn-group">
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                    <input class="btn btn-warning" type="submit" name="deactive" value="Deactive">
                    <input class="btn btn-primary" type="submit" name="reset" value="Set As Regular">
                  </div>
                </form>
                
              </td>

            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="table-responsive">
        <table style="max-height:500px;over-flow:scroll;" class="table table-condensed table-striped table-bordered table-hover " border="1">
          <caption>Currunt Users</caption>
          <thead style="background-color: #F9B01C;">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Section</th>
              <th>Posts no.</th>
              <th>Joined at</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($activeUsers as $user)
            <tr>
              <td><a href="/users/{{ $user->id }}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>
              @if(isset($user->category->category))
                <a href="/categories/{{ $user->category->id }}">
                  {{$user->category->category}}
                </a>
              @else
              <form action="/user/controle/{{$user->id}}" method="GET">
                 <div class="btn-group">
                  <select name="section" class="form-control">
                    <option disabled selected>- not selected yet -</option>
                  
                    @foreach ($allcategories as $cat)
                    <option value="{{$cat->id}}">{{$cat->category}}</option>
                    @endforeach
                  </select>
                  <input class="btn btn-sm btn-primary" type="submit" name="cat" value="submit">
                </div>
              </form>
              @endif
              </td>
              <td>{{$user->posts->count()}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
              <td>
                <form action="/user/controle/{{$user->id}}" method="get">
                  <div class="btn-group">
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                    <input class="btn btn-warning" type="submit" name="deactive" value="Deactive">
                    <input class="btn btn-success" type="submit" name="reset" value="Set As Admin">
                  </div>
                </form>
                
              </td>

            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      
    </div>

  </div>
    </div>
@stop