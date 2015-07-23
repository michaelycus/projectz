<?php

namespace App;

use DB;
use Log;
use Input;
use Illuminate\Database\Eloquent\Model;

class ReviewItem extends Model
{
    protected $fillable = array('title', 'review_id', 'checked');

    public function handle($review)
    {
        $review_options =  DB::table('review_options')->where('type', $review['reviewable_type'])->get();
        $count = 0;
        foreach ($review_options as $option)
        {
            ReviewItem::create(array(
                'title'     => $option->title,
                'review_id' => $review['id'],
                'checked'   => Input::has($option->id)
            ));
            if (Input::has($option->id)){
                $count++;
            }
        }
        $review['score'] = $count * 100 / count($review_options);
        $review->update();
    }
}

