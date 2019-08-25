<?php

namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
    protected $fillable = [
        'title',
        'description',
        'path',
        'canonical_url',
        'robot_index',
        'robot_follow',
        'change_frequency',
        'priority',
        'schema',
        'focus_keyword'
    ];


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
     * @param string $for
     * @return
     */
    public function getLeadImageAttribute($for = 'og')
    {
        $image = $this->pageImages()->first();
        if (!empty($image)) {
            return $image->getSrc();
        } else {
            return null;
        }
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
        return !empty($this->canonical_url) ? $this->canonical_url : $this->getFullUrl();
    }

    /**
     * @return varchar
     */
    public function getFullUrl()
    {
        return url(parse_url($this->path, PHP_URL_PATH));
    }

    public function getShortPath()
    {
        return parse_url($this->path, PHP_URL_PATH);
    }

    public function getLastModifiedDate()
    {
        return $this->updated_at->format('c');
    }

    public function getChangeFrequency()
    {
        return $this->change_frequency;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return array
     */
    public function metaTags()
    {
        return MetaTag::withGroupBy($this->id, 'page', $this);
    }

    /**
     * @return mixed
     */
    public function pageLevel()
    {
        if (!empty($this->id)) {
            $sql = 'select  m.*,pm.content from seo_meta_tags as m 
                left join seo_page_meta_tags as pm on m.id=pm.seo_meta_tag_id ';
            $sql .= 'and pm.seo_page_id=:id ';
            $params['id'] = $this->id;
        } else {
            $sql = 'select * from seo_meta_tags as m ';
        }
        $sql .= ' where m.status=:status and m.visibility=:visibility';
        $params['status'] = 'active';
        $params['visibility'] = 'page';
        return MetaTag::parseTags(DB::select($sql, $params), $this);
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

    /**
     * @param array $metaValues
     * @return array
     */
    public function saveMeta($metaValues)
    {
        $retArr = [];
        foreach ($metaValues as $id => $content) {
            $pageMeta = PageMetaTag::firstOrCreate(['seo_page_id' => $this->id, 'seo_meta_tag_id' => $id]);
            $pageMeta->content = $content;
            $pageMeta->save();
            $retArr[] = $pageMeta;
        }
        return $retArr;
    }

    /**
     * @param array $images
     * @return Collection
     */
    public function saveImagesFromArray(array $images)
    {
        $ret = [];

        foreach ($images as $image) {
            if (is_array($image)) {
                if (!isset($image['src']) || empty($image['src'])) {
                    continue;
                }
                $pageImage = PageImage::firstOrCreate(['src' => $image['src'], 'page_id' => $this->id]);

                if (isset($image['title'])) {
                    $pageImage->title = $image['title'];
                }
                if (isset($image['caption'])) {
                    $pageImage->caption = $image['caption'];

                }
                if (isset($image['location'])) {
                    $pageImage->location = $image['location'];
                }
                if ($pageImage->save()) {
                    $ret[] = $pageImage;
                }
            } elseif (!empty($image)) {
                $ret[] = PageImage::firstOrCreate(['src' => $image, 'page_id' => $this->id]);
            }
        }
        return new Collection($ret);
    }

    /**
     * @param $builder
     * @param $keyword
     * @return
     */
    public function scopeSearch($builder, $keyword)
    {
        $keyword = trim($keyword);
        $arr = explode(" ", $keyword);
        foreach ($arr as $word) {
            $builder = $builder->where(function ($q) use ($word) {
                $q->orWhere('title', 'LIKE', "%" . $word . "%")->orWhere("title_source", "LIKE", "%" . $word . "%");
            });
        }
        return $builder;
    }
    /**
     * @return $this
     */
    public function destroyImages()
    {
        foreach ($this->pageImages as $image) {
            $image->delete();
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function destroyMetaTags()
    {
        foreach ($this->pageMetaTags as $meta) {
            $meta->delete();
        }
        return $this;
    }

    public function saveMetaTagByProperty($data)
    {
        return $this->saveMetaTags($data, 'property');
    }

    protected function saveMetaTags($data, $column = 'property')
    {
        $retArr = [];
        foreach ($data as $property => $content) {
            $metaTag = MetaTag::where($column, $property)->first();
            if ($metaTag) {
                $pageMeta = PageMetaTag::firstOrCreate(['seo_page_id' => $this->id, 'seo_meta_tag_id' => $metaTag->id]);
                $pageMeta->content = $content;
                $pageMeta->save();
                $retArr[] = $pageMeta;
            }
        }
        return $retArr;
    }

    public function saveMetaTagByName($data)
    {
        return $this->saveMetaTags($data, 'name');
    }
}