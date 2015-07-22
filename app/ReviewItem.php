<?php

namespace App;

use DB;
//use Illuminate\Support\Facades\Input;
use Log;
use Input;
use Illuminate\Database\Eloquent\Model;

class ReviewItem extends Model
{
    protected $fillable = array('label', 'review_id', 'checked');

    public function handle($review)
    {
//        Log::debug($request);
//        Log::debug('okie');
//        Log::debug(Input::all());

        $review_options =  DB::table('review_options')->where('type', $request['reviewable_type'])->get();
        foreach ($review_options as $option)
        {
            ReviewItem::create(array(
                'title' => $option->title,
            ))
            if (Input::has($option->id)){
                ReviewItem::create(array(
                    ''
                ))
            }
        }
    }
}
