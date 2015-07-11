<?php

namespace App;

use App\Media;
use Illuminate\Database\Eloquent\Model;

class Post extends Media
{
    const ICON = 'fa fa-facebook';

    const STATUS_SUGGESTED = 'suggested';
    const STATUS_PROOFREADING = 'proofreading';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_PUBLISHED = 'published';

    protected $fillable = array('title', 'description', 'source_url', 'user_id', 'status');

    function getAvailableStatus()
    {
        return array(
            self::STATUS_SUGGESTED,
            self::STATUS_PROOFREADING,
            self::STATUS_SCHEDULED,
            self::STATUS_PUBLISHED,
        );
    }

    function getStatusLabels()
    {
        return array(
            self::STATUS_SUGGESTED       => 'Sugeridos',
            self::STATUS_PROOFREADING    => "Em revisão",
            self::STATUS_SCHEDULED       => "Agendados",
            self::STATUS_PUBLISHED       => "Publicados"
        );
    }

    function getReviewItems()
    {
        return array(
            "Pontuação",
        );
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
