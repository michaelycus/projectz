<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    const ICON = 'fa fa-eye';
    const REVIEW_DANGER = 1;
    const REVIEW_WARNING = 2;
    const REVIEW_SUCCESS = 3;

    protected $fillable = array('body', 'reply', 'status', 'user_id', 'reviewable_id', 'reviewable_type');

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public static function getReviewStatus()
    {
        return array(
            self::REVIEW_DANGER  => "Precisa ainda de vários ajustes.",
            self::REVIEW_WARNING => "Poucos detalhes precisam ser melhorados.",
            self::REVIEW_SUCCESS => "Está pronto para ser lançado!"
        );
    }
}
