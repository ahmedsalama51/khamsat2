<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','is_active','confirmation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
    ];
    
    /*Relation between tables */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'section');
    }
    /* insure that user is admin*/

    public function isAdmin()
    {
        return $this->is_admin; // this looks for an admin column in your users table
    }
    public function isActive()
    {
        return $this->is_active; // this looks for an active column in your users table
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
