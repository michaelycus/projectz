<?php

namespace App;

use DB;
use App\Media;
use Illuminate\Database\Eloquent\Model;

class Post extends Media
{
    const ICON = 'fa fa-facebook';

    const STATUS_SUGGESTED = 'suggested';
    const STATUS_PROOFREADING = 'proofreading';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    protected $attributes = array(
        'status' => self::STATUS_SUGGESTED,
    );

    protected $fillable = array(
        'title',
        'description',
        'source_url',
        'publish_url',
        'user_id',
        'status',
        'published_at'
    );

    public function getAvailableStatus()
    {
        return array(
            self::STATUS_SUGGESTED,
            self::STATUS_PROOFREADING,
            self::STATUS_SCHEDULED,
            self::STATUS_PUBLISHED,
        );
    }

    public function getStatusLabels($index = null)
    {
        $labels = array(
            self::STATUS_SUGGESTED       => 'Sugerido',
            self::STATUS_PROOFREADING    => "Em revisão",
            self::STATUS_SCHEDULED       => "Agendado",
            self::STATUS_PUBLISHED       => "Publicado",
            self::STATUS_ARCHIVED        => "Arquivado",
        );

        return $index ? $labels[$index] : $labels;
    }

    public function getReviewOptions()
    {
        return DB::table('review_options')->where('type', 'App\Post')->get();
    }

    public function getColorByStatus($status)
    {
        switch ($status) {
            case self::STATUS_PUBLISHED:
                $color = 'success';
                break;
            case self::STATUS_SCHEDULED:
                $color = 'warning';
                break;
            case self::STATUS_SUGGESTED:
            case self::STATUS_PROOFREADING:
                $color = 'info';
                break;
            case self::STATUS_ARCHIVED:
                $color = 'danger';
                break;
            default:
                $color = 'success';
        }
        return $color;
    }

    public function scopeUnpublished($query)
    {
        $query->where('status', '!=', self::STATUS_PUBLISHED);
    }

    public function scopePublished($query)
    {
        $query->where('status', '=', self::STATUS_PUBLISHED);
    }
}
