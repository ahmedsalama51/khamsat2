<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\User;
use App\Tag;
use App\Category;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
     	$otherCategories = Category::all()->except($id);
		$category = Category::find($id);
		$catPosts = $category->posts->where('is_published','1')->sortByDesc('posted_date');
		 // return $posts;
		return view ('pages.category',compact('catPosts','category','otherCategories'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
	}
	public function store(Request $request)
	{
		$UnPubposts = Post::where('is_published','=','0')->get()->sortByDesc('created_at');
		$Pubposts = Post::where('is_published','=','1')->get()->sortByDesc('created_at');
		$allcategories = Category::all();
		$admins = User::where('is_active','1')->where('is_admin','1')->get();
		$activeUsers = User::where('is_active','1')->where('is_admin','0')->get();
		$unactiveUsers = User::where('is_active','0')->get();
		if(Auth::user() && Auth::user()->is_admin != 0)
		{
			$reqArr = array();
			foreach ($request as $key => $value) {
				$reqArr[$key] = $value;
			}
			/* set validation of post componants*/
			$validator = Validator::make($reqArr,[
				'category' => 'requierd|max:255|unique:categories',
			]);
			if($validator->fails())
			{// validator dosn't work
				Session::flash('error',$validator->messages());
				return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			}
			else
			{
				if(Category::find($request->category))
				{
					Session::flash('error','category aleady exist, please add new one!!');
					return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
				}
				$cat = new Category;
				$cat->category = $request->category;
				$cat->created_at = Carbon::now();
				$cat->updated_at = Carbon::now();
				$cat->save();
				Session::flash('massage','Category add successfully!!');
				return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			}
		}
		else
			return view('error.404');

	}
	public function controle($id,Request $request){
		if(isset($request->delete) && $request->delete == "Delete")
		{
			$category = Category::find($id);
			$category->delete();
		}
		else
		{return view ('errors.404',compact('permission','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);}
		$UnPubposts = Post::where('is_published','=','0')->get()->sortByDesc('created_at');
		$Pubposts = Post::where('is_published','=','1')->get()->sortByDesc('created_at');
		$allcategories = Category::all();
		$admins = User::where('is_active','1')->where('is_admin','1')->get();
		$activeUsers = User::where('is_active','1')->where('is_admin','0')->get();
		$unactiveUsers = User::where('is_active','0')->get();
		return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
	}
}
