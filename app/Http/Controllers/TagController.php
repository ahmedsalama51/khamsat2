<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Tag;
use App\Category;
use App\Http\Requests;

class TagController extends Controller
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
     public function show($id)
     {
     	$otherTags = Tag::all()->except($id);
		$tag = Tag::find($id);
		$tagPosts = $tag->posts->where('is_published','1')->sortByDesc('posted_date');
		// $Posts = Post::where();
		 // return $tagPosts;
		 // $tagPosts;
		return view ('pages.tags',compact('tagPosts','tag','otherTags'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
	}
}
