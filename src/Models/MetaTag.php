<?php

namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    public function pageMetaTags()
    {
        return $this->hasMany(PageMetaTag::class, 'seo_meta_tag_id');
    }

    /**
     * @param string $default_value
     * @return bool|int
     */
    public static function hasOptions($default_value = '')
    {
        return !empty($default_value) ? stripos($default_value, "|") : false;
    }

    /**
     * @param string $default_value
     * @return array|mixed
     */
    public static function getDefaultValue($default_value = '')
    {
        if (static::hasOptions($default_value) !== false) {
            return explode("|", $default_value);
        }
        return $default_value;
    }

    public static function fieldMap()
    {
        return [
            'name' => [

            ],
            'property' => [
                'og:title' => 'title',
                'og:description' => 'description',
                'og:url' => 'path',
                'twitter:title' => 'title',
                'twitter:description' => 'description',
                'twitter:url' => 'path',
                'og:image' => 'lead_image'
            ]
        ];
    }

    public static function withContent($page_id = '', $visibility = 'page')
    {
        $params = [];
        $sql = 'select  m.*,pm.content from seo_meta_tags as m 
                left join seo_page_meta_tags as pm on m.id=pm.seo_meta_tag_id ';

        if (!empty($page_id)) {
            $sql .= 'and pm.seo_page_id=:id ';
            $params['id'] = $page_id;
        }
        $sql .= ' where m.status=:status and m.visibility=:visibility';
        $params['status'] = 'active';
        $params['visibility'] = $visibility;
        return DB::select($sql, $params);
    }

    public static function forGlobal()
    {
        $params = [];
        $sql = 'select distinct m.*,pm.content from seo_meta_tags as m 
                left join seo_page_meta_tags as pm on m.id=pm.seo_meta_tag_id and pm.seo_page_id is NULL ';
        $sql .= ' where m.status=:status and m.visibility=:visibility ';
        $params['status'] = 'active';
        $params['visibility'] = 'global';
        $results = DB::select($sql, $params);
        return static::parseTags($results);
    }

    /**
     * @param string $page_id
     * @param string $visibility
     * @param string $page
     * @return array
     */
    public static function withGroupBy($page_id = '', $visibility = 'page', $page = '')
    {
        $metaTags = [];
        $results = static::withContent($page_id, $visibility);

        return static::parseTags($results, $page);
    }

    /**
     * @param $results
     * @param $page
     * @return mixed
     */
    public static function parseTags($results, $page = '')
    {
        $metaTags = [];
        foreach ($results as $meta) {

            if ($page instanceof Page) {
                $meta = $page->assignDefaultValueToMeta($meta);
            }

            if (!empty($meta->group)) {
                $metaTags[$meta->group][] = $meta;
            } elseif ($meta->visibility == 'global') {
                $metaTags['global'][] = $meta;
            } elseif ($meta->visibility == 'page') {
                $metaTags['page'][] = $meta;
            } else {
                $metaTags['others'][] = $meta;
            }
        }
        return $metaTags;
    }


}