<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Media extends Model
{
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function reviews()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }

    public function team()
    {
        return $this->morphMany('App\Team', 'teamable');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    abstract function getAvailableStatus();

    abstract function getStatusLabels();

    abstract function getReviewItems();
}