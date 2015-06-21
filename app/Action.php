<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model {

	//protected $morphClass = 'Action';

	protected $fillable = array('action', 'user_id', 'actionable_id', 'actionable_type');

	public function actionable()
    {
       return $this->morphTo();
    }

	public function user()
    {
        return $this->belongsTo('App\User');
    }

}