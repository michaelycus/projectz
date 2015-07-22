<?php namespace App;

use App\Media;
use Illuminate\Database\Eloquent\Model;

class Video extends Media
{
    const ICON = 'fa fa-film';

    const STATUS_TRANSCRIPTION = 'transcription';
    const STATUS_SYNCHRONIZATION = 'sync';
    const STATUS_TRANSLATION = 'translation';
    const STATUS_PROOFREADING = 'proofreading';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    protected $attributes = array(
        'status' => self::STATUS_TRANSCRIPTION,
    );

    protected $fillable = array(
        'title',
        'description',
        'duration',
        'thumbnail',
        'source_url',
        'project_url',
        'publish_url',
        'published_at',
        'user_id',
        'status'
    );

    public function getAvailableStatus()
    {
        return array(
            self::STATUS_TRANSCRIPTION,
            self::STATUS_SYNCHRONIZATION,
            self::STATUS_TRANSLATION,
            self::STATUS_PROOFREADING,
            self::STATUS_SCHEDULED,
            self::STATUS_PUBLISHED,
        );
    }

    public function getStatusLabels($index = null)
    {
        $labels = array(
            self::STATUS_TRANSCRIPTION   => 'Em Transcrição',
            self::STATUS_SYNCHRONIZATION => 'Sincronizando',
            self::STATUS_TRANSLATION     => 'Tradução',
            self::STATUS_PROOFREADING    => "Em revisão",
            self::STATUS_SCHEDULED       => "Agendado",
            self::STATUS_PUBLISHED       => "Publicado",
            self::STATUS_ARCHIVED        => "Arquivado"
        );

        return $index ? $labels[$index] : $labels;
    }

    public function getReviewOptions()
    {
        return array(
            "80 caracteres por linha",
        );
    }

    public function scopeUnpublished($query)
    {
        $query->where('status', '!=', self::STATUS_PUBLISHED);
    }

    public function scopePublished($query)
    {
        $query->where('status', '=', self::STATUS_PUBLISHED);
    }

    public function getByState($state)
    {
        return Video::where('state', $state)->get();
    }

    public function handle($data)
    {
        if (array_key_exists('source_url', $data)) {
            $source_url = $data['source_url'];

            if (strpos($source_url, 'youtu') !== false) {
                preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",
                    $source_url, $matches);

                try {
                    //$json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/$matches[0]?v=2&alt=jsonc"));

                    $json = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=' . $matches[0] . '&part=snippet,contentDetails&key=' . env('YOUTUBE_KEY')));

                    $data['title'] = $json->items[0]->snippet->title;
                    $data['duration'] = $this->convertISO8601DurationToSeconds($json->items[0]->contentDetails->duration);
                    $data['thumbnail'] = $json->items[0]->snippet->thumbnails->high->url;

                    // $data['title'] 		= $json->data->title;
                    // $data['duration']	= $json->data->duration;
                    // $data['thumbnail'] 	= $json->data->thumbnail->sqDefault;

                } catch (Exception $e) {
                    $json = null;
                }
            } elseif (strpos($source_url, 'vimeo') !== false) {
                $video_id = substr(parse_url($source_url, PHP_URL_PATH), 1);

                $json_data = file_get_contents("http://vimeo.com/api/v2/video/" . $video_id . '.json');
                $json = json_decode($json_data);

                $data['title'] = $json[0]->title;
                $data['duration'] = $json[0]->duration;
                $data['thumbnail'] = $json[0]->thumbnail_large;
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
            + $interval->s;

        return (int)$seconds;
    }
}
