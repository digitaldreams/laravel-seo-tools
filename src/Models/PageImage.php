<?php

namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $src src
 * @property tinyint $width width
 * @property tinyint $height height
 * @property int $page_id page id
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property SeoPage $seoPage belongsTo
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
     * Date time columns.
     */
    protected $dates = [];

    /**
     * seoPage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seoPage()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }


}