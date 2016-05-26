<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description','image', 'content','posted_date','is_published'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'category_id', 'user_id','views_num',
    ];
    /*Relation between tables */
    public function tags()
    {
    	return $this->belongsToMany(Tag::class,'post_tag','post_id','tag_id');
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
