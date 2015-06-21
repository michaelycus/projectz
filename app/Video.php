<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

	protected $fillable = array('title', 'duration', 'thumbnail', 'source_url', 'project_url', 'publish_url', 'user_id', 'status');

	public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function actions()
    {
        return $this->morphMany('App\Action', 'actionable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeUnpublished($query)
    {
        $query->where('status', '!=', VIDEO_STATUS_PUBLISHED);
    }

    public function scopePublished($query)
    {
        $query->where('status', '=', VIDEO_STATUS_PUBLISHED);
    }

    public function handle($data)
    {
    	if (array_key_exists('source_url', $data))
    	{
    		$source_url = $data['source_url'];

			if (strpos($source_url,'youtu') !== false) {
				preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",  $source_url, $matches);

				try{
					//$json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/$matches[0]?v=2&alt=jsonc"));

				    $json = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$matches[0].'&part=snippet,contentDetails&key='. env('YOUTUBE_KEY')));

				    $data['title'] 		= $json->items[0]->snippet->title;
				    $data['duration']	= $this->convertISO8601DurationToSeconds($json->items[0]->contentDetails->duration);
					$data['thumbnail'] 	= $json->items[0]->snippet->thumbnails->high->url;

					// $data['title'] 		= $json->data->title;
					// $data['duration']	= $json->data->duration;
					// $data['thumbnail'] 	= $json->data->thumbnail->sqDefault;

				} catch (Exception $e){
					$json = NULL;
				}
			}
			elseif (strpos($source_url,'vimeo') !== false) {
				$video_id =  substr(parse_url($source_url, PHP_URL_PATH), 1);

				$json_data = file_get_contents("http://vimeo.com/api/v2/video/".$video_id.'.json');
				$json = json_decode($json_data);
						
				$data['title'] 		= $json[0]->title;
				$data['duration'] 	= $json[0]->duration;
				$data['thumbnail'] 	= $json[0]->thumbnail_large;
			}	
    	}
    	return $data;
    	
    }


    private function convertISO8601DurationToSeconds($iso8601DurationStr)
    {
        $interval = new \DateInterval($iso8601DurationStr);

        // @note: the assumption that one year = 365 days and one month = 31 days is not the rightest one
        // but I doubt that video duration can be more than some hours.
        $seconds = $interval->y * (365 * 24 * 3600)
                + $interval->m * (31 * 24 * 3600)
                + $interval->d * (24 * 3600)
                + $interval->h * 3600
                + $interval->i * 60
                + $interval->s
            ;

        return (int) $seconds;
    }

}
