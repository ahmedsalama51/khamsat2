<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Comment;
use App\Post;
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



class CommentController extends Controller
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
    
	/* add new comment */
	public function store($post_id, Request $request){
		/* set validation of post componants*/
		$post = Post::find($post_id);
		$validator = Validator::make($request->all(),[
			'content' => 'Required|min:6',
		]);
		if($validator->fails())
		{// validator dosn't work
			$errors = $validator->messages();
			return 'error';
			// return view ('/posts/'.$post->id.'/'.$post->title,compact('errors'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}
		else
		{
			$user = Auth::user();
			if($user->is_active == 1)
			{
				$comment = new Comment;
				$comment->content = $request->content;
				$comment->created_at = Carbon::now();
				$comment->updated_at = Carbon::now();
				// $comment->post_id = $post->id;
				$comment->post_id = $request->post_id;
				$comment->user_id = $user->id;
				$comment->user_token = $user->confirmation_code;
				$comment->save();
				$data = array('user'=>$user,'comment'=>$comment);
			    return $data;
			}
		    // return view ('/posts/'.$post->id.'/'.$post->title,['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}//end of valid validator
	}
	public function append($post_id,$comment_id,Request $request){
		/* set validation of post componants*/
		$post = Post::find($post_id);
		$validator = Validator::make($request->all(),[
			'content' => 'Required|min:6',
		]);
		if($validator->fails())
		{// validator dosn't work
			$errors = $validator->messages();
			return $errors;
			// return view ('/posts/'.$post->id.'/'.$post->title,compact('errors'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
		}
		else
		{
			$user = Auth::user();
			$comment = Comment::find($comment_id);
			if($user->is_active == 1 && $comment->user_token == $user->confirmation_code)
			{
				
				$comment->content = $request->content;
				$comment->updated_at = Carbon::now();
				$comment->save();				
			    $data = array('user'=>$user,'comment'=>$comment);
			    return $posr->comments;
			}
			else
			{
				$errors = "You are not authorize to be here, sorry for disapoint you, we are SECUIRE";
				return view ('errors.404',compact('errors','post_tags','post','user','category'),['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
			}
		    // return view ('/posts/'.$post->id.'/'.$post->title,['posts'=> $this->posts,'categories'=> $this->categories,'tags'=> $this->tags,'topviewd'=>$this->topviewd]);
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
	


}
