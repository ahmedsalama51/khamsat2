<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function users()
    {
    	return $this->hasMany(User::class,'section');
    }
    public function posts()
    {
    	return $this->hasMany(Post::class);
    }
}
