<?php

namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $path path
 * @property varchar $route_name route name
 * @property varchar $robot_index robot index
 * @property varchar $robot_follow robot follow
 * @property varchar $canonical_url canonical url
 * @property varchar $title title
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property \Illuminate\Database\Eloquent\Collection $seoPageImage hasMany
 * @property \Illuminate\Database\Eloquent\Collection $seoPageMetaTag hasMany
 */
class Page extends Model
{

    /**
     * Database table name
     */
    protected $table = 'seo_pages';
    /**
     * Protected columns from mass assignment
     */
    protected $guarded = ['id'];


    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * seoPageImages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pageImages()
    {
        return $this->hasMany(PageImage::class, 'page_id');
    }

    /**
     * seoPageMetaTags
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pageMetaTags()
    {
        return $this->hasMany(PageMetaTag::class, 'page_id');
    }

    /**
     * Get Page Title
     * @return mixed|varchar
     */
    public function getTitle()
    {
        return !empty($this->title) ? $this->title : $this->title_source;
    }

    /**
     * Get Meta Description
     * @return mixed
     */
    public function getDescription()
    {
        return !empty($this->description) ? $this->description : $this->description_source;
    }

    /**
     * Get Meta Description
     * @return mixed
     */
    public function getCanonical()
    {
        return !empty($this->canonical_url) ? $this->canonical_url : $this->path;
    }

    /**
     * @return array
     */
    public function metaTags()
    {
        return MetaTag::withGroupBy($this->id, 'page', $this);
    }

    public function assignDefaultValueToMeta($meta)
    {
        if (empty($meta->content)) {
            $fieldMap = MetaTag::fieldMap();
            if (!empty($meta->name) && isset($fieldMap['name'][$meta->name])) {
                $pageFieldName = $fieldMap['name'][$meta->name];
                $meta->content = $this->$pageFieldName;
            } elseif (!empty($meta->property) && isset($fieldMap['property'][$meta->property])) {
                $pageFieldName = $fieldMap['property'][$meta->property];
                $meta->content = $this->$pageFieldName;
            } elseif (!empty($meta->property) && in_array($meta->property, ['og:image', 'twitter:image'])) {
                $img = $this->pageImages->first();
                $meta->content = is_object($img) ? url($img->src) : null;
            }
        }
        return $meta;
    }

}