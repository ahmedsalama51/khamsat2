<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use Session;

use App\Http\Requests;

class UserControllers extends Controller
{
    var $posts;
    var $tags;
    var $categories; 
    public function __construct()
    {
    	// recent 3 posts
		$this->posts = Post::where('is_published','1')->get()->sortByDesc('posted_date')->take(3);
		// top 3 viewd post
		$this->topviewd = Post::where('is_published','1')->get()->sortByDesc('views_num')->take(3);
		// recent 3 tags
		$this->tags = Tag::all()->take(3)->reverse();
		// recent 3 categories
		$this->categories = Category::all()->take(3)->reverse();
    }
    public function show($id){
		$user = User::find($id);
		$posts = $user->posts->where('is_published','1')->sortByDesc('posted_date')->take(4);
		$category = $user->category;
		return view ('pages.usershow',compact('user','posts','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
	}
	public function admin(){
		$UnPubposts = Post::where('is_published','=','0')->get()->sortByDesc('created_at');
		$Pubposts = Post::where('is_published','=','1')->get()->sortByDesc('created_at');
		$allcategories = Category::all();
		$admins = User::where('is_active','1')->where('is_admin','1')->get();
		$activeUsers = User::where('is_active','1')->where('is_admin','0')->get();
		$unactiveUsers = User::where('is_active','0')->get();
		return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
	}

	public function control($id , Request $request){
		$user = user::find($id);
		$UnPubposts = Post::where('is_published','=','0')->get()->sortByDesc('created_at');
		$Pubposts = Post::where('is_published','=','1')->get()->sortByDesc('created_at');
		$allcategories = Category::all();
		$admins = User::where('is_active','1')->where('is_admin','1')->get();
		$activeUsers = User::where('is_active','1')->where('is_admin','0')->get();
		$unactiveUsers = User::where('is_active','0')->get();
		if($user)
		{
			if(isset($request->delete) && $request->delete == "Delete")
			{
				if($user->where('id','!=','1'))
					$user->delete();
				else
				{
					Session::flash('error', 'this is First admin , which cannot delete !!');
					return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
				}
			}
			elseif(isset($request->active) && $request->active == "Active")
			{
				if($user ->where('is_active', '0'))
				{
					$user->is_active = 1;
					$user->save();
				}
				else
				{
					Session::flash('error', 'this user is already active !!');
					return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
				}
			}
			elseif(isset($request->deactive) && $request->deactive == "Deactive")
			{
				if($user->where('is_active', '1'))
				{
					$user->is_active = 0;
					$user->save();
				}
				else
				{
					Session::flash('error', 'this user is aready not active !!');
					return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
				}
			}
			elseif(isset($request->reset) && $request->reset == "Set As Regular")
			{
				if($user->where('is_admin', '1'))
				{
					$user->is_admin = 0;
					$user->save();
				}
				else
				{
					Session::flash('error', 'this user is aready Regular User !!');
					return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
				}
			}
			elseif(isset($request->reset) && $request->reset == "Set As Admin")
			{
				if($user->where('is_admin', '0'))
				{
					$user->is_admin = 1;
					$user->save();
				}
				else
				{
					Session::flash('error', 'this user is aready not Admin !!');
					return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
				}
			}
			elseif(isset($request->cat) && $request->cat == "submit")
			{
				if($request->section)
				{
					$user->section = $request->section;
					$user->save();
				}
				else
				{
					Session::flash('error', 'cannont add this user to category !!');
					return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
				}
			}
			else
				return view ('errors.404',compact('permission','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			
			Session::flash('massage', 'User Updated Successfully !!');
			return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			
		}
		else
			return view ('errors.404',compact('permission','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);

		
		
	}

}
