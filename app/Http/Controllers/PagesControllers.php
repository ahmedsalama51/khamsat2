<?php

namespace App\Http\Controllers;

// use DB;
use App\Post;
use App\User;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesControllers extends Controller
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
		// $this->tags = \DB::table('tags')->get();
		$this->tags = Tag::all()->take(3)->reverse();
		// $this->categories = \DB::table('categories')->get();
		$this->categories = Category::all()->take(3)->reverse();
    }
	
	public function index(){

		// return view ('index',compact('posts','tags','categories'));
		$sortedPosts = Post::all()->where('is_published','1')->sortByDesc('posted_date');
		$slideposts = $sortedPosts->take(6);
		$recent2posts = $sortedPosts->slice(6,4)->reverse();
		$recent4posts = $sortedPosts->slice(10,4)->reverse();
		// return $recent2posts;
		return view('index',compact('slideposts','recent2posts','recent4posts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
	}

	public function about(){
		$users = User::all();
		return view ('pages.about',compact('users'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
	}

	public function search(Request $request){

		$searchterm = $request->searchinput;
		// return $searchterm;
		if ($searchterm)
		{          
		    $resultofpost = \DB::table('posts')->where('title', 'LIKE', '%'. $searchterm .'%')
		    ->orWhere('description', 'LIKE', '%'. $searchterm .'%')
		    ->get();
		    
		    $resultoftag = \DB::table('tags')
		    ->where('tag', 'LIKE', '%'. $searchterm .'%')
		    ->get();
		    
		    $resultofcategory = \DB::table('categories')
		    ->where('category', 'LIKE', '%'. $searchterm .'%')
		    ->get();

		    $resultofuser = \DB::table('users')
		    ->where('name', 'LIKE', '%'. $searchterm .'%')
		    ->orWhere('email', 'LIKE', '%'. $searchterm .'%')
		    ->get();
				return view('pages.search',compact('resultofpost','resultoftag','resultofcategory','resultofuser'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
	    }
 }


}
