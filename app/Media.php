<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Media extends Model
{
    const ICON = 'fa fa-users';

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

    public function isArchived()
    {
        return $this->status == 'archived';
    }

    abstract function getAvailableStatus();

    abstract function getStatusLabels();

    abstract function getReviewItems();
}
