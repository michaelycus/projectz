<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = array('body', 'reply', 'status', 'user_id', 'reviewable_id', 'reviewable_type');

}
