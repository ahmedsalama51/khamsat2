<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content','post_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'user_id','parent_id',
    ];
    /*Relation between tables */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function post()
    {
    	return $this->belongsTo(Post::class,'post_id');
    }
    public function replay()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }
}
