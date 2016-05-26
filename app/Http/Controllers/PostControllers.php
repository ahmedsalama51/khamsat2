<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Post;
use App\Comment;
use App\User;
use App\Tag;
use App\Category;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Session;
use Redirect;
use Illuminate\Support\Facades\Validator;



class PostControllers extends Controller
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
    public function show($id,$title){
		$post = Post::where('is_published', '1')->find($id);
		$comments = Comment::where('post_id',$id)->get();
		// die($comments);
		if(sizeof($post) > 0)
		{
			if (isset(Auth::user()->id) && Auth::user()->isAdmin()) 
			{
				$permission = 2;
			}
			elseif(isset(Auth::user()->id) && Auth::user()->id == $post->user_id)// the author user is the currunt loged user
			{
				if(strtotime(Carbon::now()) - strtotime($post->created_at) > 3600	)
					$permission = 0; // there is more than hour have passed
				else
					$permission = 1; // still have time to edit or delete
			}
			// elseif(isset(Auth::user()->id) && Auth::user()->id == $comments->user_id)// add permission on edit comment
			// {
			// 	if(strtotime(Carbon::now()) - strtotime($post->created_at) > 3600	)
			// 		$permission = 0; // there is more than hour have passed
			// 	else
			// 		$permission = 3; // still have time to edit or delete
			// }
			else
			{
				$permission = 0;
			}
			// increase view by 1 
			$post ->views_num +=1 ;
			$post ->save();
			// $user = User::find($post->user_id);
			$user = $post->user;
			// $category = Category::find($user->category_id);
			$category = $post->category;
			// Event::fire('posts.view', $post);
			$tags = DB::table('post_tag')->select('tag_id')->where('post_id','=',$id)->get();
			foreach ($tags as $key => $id) {
				 $post_tags[] = Tag::find($id->tag_id);
			}
			return view ('pages.single',compact('permission','post_tags','post','user','category','comments'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}
		else	
			return view ('errors.404',compact('permission','post_tags','post','user','category','comments'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);

	}
	/* add new post */
	public function add(){
		if(Auth::user() && Auth::user()->section != Null)
			return view ('pages.addPost',['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		else
			return view('/auth.login');
		// return view ('pages.addPost',['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);

	}

	public function store(Request $request){
		$reqArr = array();
		foreach ($request as $key => $value) {
			$reqArr[$key] = $value;
		}
		/* set validation of post componants*/
		$validator = Validator::make($request->all(),[
			'title' => 'Required|max:255|unique:posts,title',
			'description' => 'Required|max:100',
			'content' => 'Required|min:6',
			'image' => 'Required',
			'posted_date' => 'Required',
		]);
		if($validator->fails())
		{// validator dosn't work
			$errors = $validator->messages();
			return view ('pages.addPost',compact('errors'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}
		else
		{
			$user = Auth::user();
			$post = new Post;
			$post->title = $request->title;
			$post->description = $request->description;
			$post->content = $request->content;
			$post->posted_date = $request->posted_date;
			$post->created_at = Carbon::now();
			$post->updated_at = Carbon::now();
			$post->user_id = $user->id;
			$post->user_token = $user->confirmation_code;
			$post->category_id = $user->section;
			if (Input::hasFile('image') && Input::file('image')->isValid()) 
			{
				$file = Input::file('image');
				$destinationPath = public_path(). '/post_pictures/';
				$extension = Input::file('image')->getClientOriginalExtension();
				$filename = $request->title.'.'.$extension;
				$post->image = '/post_pictures/'.$filename;
				Input::file('image')->move($destinationPath, $filename);
				Image::make($destinationPath.$filename)->insert(public_path().'/images/watermark.png','bottom-right')->resize(500, 420)->save($destinationPath.$filename);

				$post->save();
				/* add tags*/
				if($request->tags)
				{
					$currunt_post_id = Post::where('title','=',$request->title)->get();
					$postTagTable = DB::table('post_tag'); 
					// $post_tag = new $postTagTable;
					$tags_Arr_with_hash = explode(' ', $request->tags);
					for ($i=0;$i<sizeof($tags_Arr_with_hash);$i++) 
					{ 
						$tags_Arr = explode('#', $tags_Arr_with_hash[$i]);
						if(isset($tags_Arr[1]))
						{
							$tag_word = $tags_Arr[1];
							$exsist = Tag::select('id')->where('tag' , '=',$tag_word)->get();
							if(sizeof($exsist) == 1) 
							{
								$post->tags()->attach($exsist);
							}// if this tag aleady exsist befor
							else 
							{
								// return 'hit';
								$tag = new Tag;
								$tag->tag = $tag_word;
								$tag->save();
								$currunt_tag_id = Tag::where('tag' , '=',$tag_word)->get();
								$post->tags()->attach($currunt_tag_id);
								
							 }// if this tag is new word
						}//if tag start with #
					}// end of tags
				}// if there is any tags
				

				// /* add water mark and resize image*/
				// open an image file
				// $img = Image::make($destinationPath.$filename);

				// // now you are able to resize the instance
				// $img->resize(220, 140);

				// // and insert a watermark for example
				// $img->insert('public/images/watermark.png');

				// // finally we save the image as a new file
				// $img->save($destinationPath.$filename);
				Session::put('error', 'post add succssufully , you will be able to Edit Or Delete For about 1 Hour');
			    return view ('pages.addPost',['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			}
			else 
			{
			      // sending back with error message.
			      Session::flash('error', 'uploaded file is not valid');
			    return view ('pages.addPost',['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			}
		}//end of valid validator
	}
	public function edit($id){

		$post = Post::where('is_published', '1')->find($id);
		if (Auth::user() && Auth::user()->id == $post->user_id && Auth::user()->confirmation_code == $post->user_token)
		{

			if(sizeof($post))
			{
				$tags = DB::table('post_tag')->select('tag_id')->where('post_id','=',$id)->get();
				foreach ($tags as $key => $id) {
					 $post_tags[] = Tag::find($id->tag_id);
				}
				  
				if(Auth::user())
					return view ('pages.editPost',compact('post','post_tags'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
				else
					return view('/auth.login');
			}
			else
				return view ('errors.404',compact('permission','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}
		else
		{
			$errors = "You are not authorize to be here, sorry for disapoint you, we are SECUIRE";
			return view ('errors.404',compact('errors','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}


	}
	public function append($id,Request $request){
		$reqArr = array();
		foreach ($request as $key => $value) {
			$reqArr[$key] = $value;
		}
		/* set validation of post componants*/
		$validator = Validator::make($request->all(),[
			'title' => 'Required|max:255|unique:posts,title',
			'description' => 'Required|max:100',
			'content' => 'Required|min:6',
			'image' => 'Required',
			'posted_date' => 'Required',
		]);
		if($validator->fails())
		{// validator dosn't work
			$errors = $validator->messages();
			return view ('pages.addPost',compact('errors'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}
		else
		{

		
			$user = Auth::user();
			$post = Post::find($id);
			$post->title = $request->title;
			$post->description = $request->description;
			$post->content = $request->content;
			$post->posted_date = $request->posted_date;
			$post->created_at = Carbon::now();
			$post->updated_at = Carbon::now();
			$post->user_id = $user->id;
			$post->user_token = $user->confirmation_code;
			$post->category_id = $user->section;
			if (Input::hasFile('image') && Input::file('image')->isValid()) 
			{
				$file = Input::file('image');
				$destinationPath = public_path(). '/post_pictures/';
				$extension = Input::file('image')->getClientOriginalExtension();
				$filename = $request->title.'.'.$extension;
				$post->image = '/post_pictures/'.$filename;
				Input::file('image')->move($destinationPath, $filename);
				Image::make($destinationPath.$filename)->insert(public_path().'/images/watermark.png','bottom-right')->resize(500, 420)->save($destinationPath.$filename);

				$post->save();
				/* add tags*/
				if($request->tags)
				{
					$currunt_post_id = Post::where('title','=',$request->title)->get();
					$postTagTable = DB::table('post_tag'); 
					// $post_tag = new $postTagTable;
					$tags_Arr_with_hash = explode(' ', $request->tags);
					for ($i=0;$i<sizeof($tags_Arr_with_hash);$i++) 
					{ 
						$tags_Arr = explode('#', $tags_Arr_with_hash[$i]);
						if(isset($tags_Arr[1]))
						{
							$tag_word = $tags_Arr[1];
							$exsist = Tag::select('id')->where('tag' , '=',$tag_word)->get();
							if(sizeof($exsist) == 1) 
							{
								$post->tags()->attach($exsist);
							}// if this tag aleady exsist befor
							else 
							{
								// return 'hit';
								$tag = new Tag;
								$tag->tag = $tag_word;
								$tag->save();
								$currunt_tag_id = Tag::where('tag' , '=',$tag_word)->get();
								$post->tags()->attach($currunt_tag_id);
								
							 }// if this tag is new word
						}//if tag start with #
					}// end of tags
				}// if there is any tags
				Session::put('error', 'post updated succssufully');
			    return view ('pages.editPost',compact('post'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			}
			else 
			{
			      // sending back with error message.
			      Session::flash('error', 'uploaded file is not valid');
			    return view ('pages.editPost',compact('post'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			}
		}//end of valid validator
	}
	public function destroy($id){
		$post = Post::where('is_published', '1')->find($id);
		if (Auth::user() && Auth::user()->id == $post->user_id && Auth::user()->confirmation_code == $post->user_token)
		{
			if(sizeof($post) > 0)
			{
				$post->delete();
				return view ('pages.addPost',['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			}
			else
				return view ('errors.404',compact('permission','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}
		else
		{
			$errors = "You are not authorize to be here, sorry for disapoint you, we are SECUIRE";
			return view ('errors.404',compact('errors','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}
	}
	public static function is_editedable($id){
		$post = Post::where('is_published', '1')->find($id);
		// $post = Post::find($id);
		if(sizeof($post) > 0)
		{
			if(Auth::user()->id == $post->user_id && Auth::user()->remember_token == $post->user_token)// the author user is the currunt loged user
			{
				$permission = 1;
			}
			elseif (Auth::user()->is_Admin()) 
			{
				$permission = 2;
			}
			else
			{
				$permission = 0;
			}
			return $permission;
		}
		else
			return view ('errors.404',compact('permission','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);

	}
	public function controle($id,Request $request){
		if(isset($request->delete) && $request->delete == "Delete")
		{
			$post = Post::find($id);
			$post->delete();
		}
		elseif(isset($request->publish) && $request->publish == "Publish")
		{
			$post = Post::where('is_published', '0')->find($id);
			$post->is_published = 1;
			$post->save();
		}
		elseif(isset($request->publish) && $request->publish == "unPublish")
		{
			$post = Post::where('is_published', '1')->find($id);
			$post->is_published = 0;
			$post->save();
		}
		else
			return view ('errors.404',compact('permission','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		$UnPubposts = Post::where('is_published','=','0')->get()->sortByDesc('created_at');
		$Pubposts = Post::where('is_published','=','1')->get()->sortByDesc('created_at');
		$allcategories = Category::all();
		$admins = User::where('is_active','1')->where('is_admin','1')->get();
		$activeUsers = User::where('is_active','1')->where('is_admin','0')->get();
		$unactiveUsers = User::where('is_active','0')->get();
		return view ('pages.admin',compact('admins','unactiveUsers','activeUsers','allcategories','UnPubpostsCount','UnPubposts','PubpostsCount','Pubposts'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);

	}


}
