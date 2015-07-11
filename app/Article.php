<?php namespace App;


class Article extends Media
{
    const STATUS_EDITING = 'editing';
    const STATUS_PROOFREADING = 'proofreading';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_PUBLISHED = 'published';

    const ICON = 'fa fa-wordpress';

    protected $attributes = array(
        'status' => self::STATUS_EDITING,
    );

    protected $fillable = array('title', 'source_url', 'project_url', 'publish_url', 'user_id', 'status');

    public function scopeUnpublished($query)
    {
        $query->where('status', '!=', self::STATUS_PUBLISHED);
    }

    public function scopePublished($query)
    {
        $query->where('status', '=', self::STATUS_PUBLISHED);
    }

    function getAvailableStatus()
    {
        return array(
            self::STATUS_EDITING,
            self::STATUS_PROOFREADING,
            self::STATUS_SCHEDULED,
            self::STATUS_PUBLISHED
        );
    }

    function getStatusLabels()
    {
        return array(
            self::STATUS_EDITING      => "Em edição",
            self::STATUS_PROOFREADING => "Em revisão",
            self::STATUS_SCHEDULED    => "Agendados",
            self::STATUS_PUBLISHED    => "Publicados"
        );
    }

    function getReviewItems()
    {
        return array(
            "Conteúdo dentro do escopo",
            "Ortografia",
            "Formatação",
            "Imagem Destacada (min 1280x720 16:9)",
            "Categorias",
            "Open Graph Data",
            "Links",
            "Tags",
        );
    }

}