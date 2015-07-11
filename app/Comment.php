<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	const ICON = 'fa fa-comment-o';

	protected $fillable = array('body', 'user_id', 'commentable_id', 'commentable_type', 'reply_id');

	public function commentable()
    {
       return $this->morphTo();
    }

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getReplies($id)
    {
        return Comment::where('reply_id', $id)->orderBy('id', 'asc')->get();
    }

}
