<?php

namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $src src
 * @property string $caption Caption
 * @property string $title Title
 * @property int $page_id page id
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property Page $page belongsTo
 */
class PageImage extends Model
{

    /**
     * Database table name
     */
    protected $table = 'seo_page_images';
    /**
     * Protected columns from mass assignment
     */
    protected $guarded = ['id'];

    /**
     * seoPage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function getSrc()
    {
        if (parse_url($this->src, PHP_URL_HOST)) {
            return $this->src;
        }
        return asset($this->src);
    }

    /**
     * @return varchar
     */
    public function getFullUrl()
    {
        if (parse_url($this->src, PHP_URL_HOST)) {
            return $this->src;
        }
        url($this->src);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function getLocation()
    {
        return $this->location;
    }

}