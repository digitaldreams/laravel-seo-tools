<?php

namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $seo_page_id seo page id
 * @property int $seo_meta_tag_id seo meta tag id
 * @property text $content content
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property SeoMetaTag $seoMetaTag belongsTo
 * @property SeoPage $seoPage belongsTo
 */
class PageMetaTag extends Model
{

    /**
     * Database table name
     */
    protected $table = 'seo_page_meta_tags';
    /**
     * Protected columns from mass assignment
     */
    protected $guarded = ['id'];


    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * seoMetaTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seoMetaTag()
    {
        return $this->belongsTo(MetaTag::class, 'seo_meta_tag_id');
    }

    /**
     * seoPage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seoPage()
    {
        return $this->belongsTo(Page::class, 'seo_page_id');
    }



}