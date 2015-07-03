<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = array('title', 'description', 'source_url', 'user_id', 'status');

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function checks()
    {
        return $this->morphMany('App\Check', 'checkable');
    }

    public function actions()
    {
        return $this->morphMany('App\Action', 'actionable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeUnpublished($query)
    {
        //$query->where('status', '!=', VIDEO_STATUS_PUBLISHED);
    }

    public function scopePublished($query)
    {
        //$query->where('status', '=', VIDEO_STATUS_PUBLISHED);
    }
}
