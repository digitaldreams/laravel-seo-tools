<?php

namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $name name
 * @property varchar $property property
 * @property varchar $status status
 * @property varchar $group group
 * @property varchar $input_type input type
 * @property varchar $input_help_text input help text
 * @property varchar $input_placeholder input placeholder
 * @property varchar $input_label input label
 * @property varchar $input_info input info
 * @property varchar $visibility visibility
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property \Illuminate\Database\Eloquent\Collection $seoPageMetaTag hasMany
 */
class MetaTag extends Model
{

    /**
     * Database table name
     */
    protected $table = 'seo_meta_tags';
    /**
     * Protected columns from mass assignment
     */
    protected $guarded = ['id'];


    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * seoPageMetaTags
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seoPageMetaTags()
    {
        return $this->hasMany(PageMetaTag::class, 'seo_meta_tag_id');
    }


}