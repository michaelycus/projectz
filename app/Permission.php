<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    const TYPE_VIDEO = 'p_vid';
    const VIDEO_EXECUTE = 'p_vid_1';
    const VIDEO_CREATE = 'p_vid_2';
    const VIDEO_MANAGE = 'p_vid_3';

    const TYPE_ARTICLE = 'p_art';
    const ARTICLE_EXECUTE = 'p_art_1';
    const ARTICLE_CREATE = 'p_art_2';
    const ARTICLE_MANAGE = 'p_art_3';

    const TYPE_POST = 'p_pos';
    const POST_EXECUTE = 'p_pos_1';
    const POST_CREATE = 'p_pos_2';
    const POST_MANAGE = 'p_pos_3';

    const SYSTEM_MANAGER = 'p_sys_1';

    const PERMISSION_YES = '<i class="fa fa-check text-success"></i>';
    const PERMISSION_NO = '<i class="fa fa-times text-danger"></i>';

    protected $fillable = ['user_id', 'type'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
