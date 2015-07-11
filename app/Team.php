<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    const ICON = 'fa fa-group';

    protected $fillable = array('user_id', 'teamable_id', 'teamable_type');

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
