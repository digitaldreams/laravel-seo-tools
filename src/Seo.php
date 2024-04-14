<?php
/**
 * User: Tuhin
 * Date: 12/30/2017
 * Time: 2:36 PM
 */

namespace SEO;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use SEO\Models\Page;
use SEO\Models\PageImage;
use SEO\Services\KeywordAnalysis;

class Seo
{
    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $request;
    /**
     * @var
     */
    protected $page;

    /**
     * @var
     */
    protected $filePath;

    /**
     * @var \SplFileObject
     */
    protected $splFileObject;

    /**
     * Seo constructor.
     */
    public function __construct()
    {
        $this->request = app('request');
        $path = $this->request->path();
        $this->page = Page::whereIn('path', [trim((string) $path, "/"), "/" . $path, url($path)])->first();

        if ($this->page) {

            if (config('seo.cache.driver') == 'file') {
                $this->filePath = rtrim((string) config('seo.cache.storage'), "/") . '/' . $this->page->id . '.html';

                if (file_exists($this->filePath)) {
                    $this->splFileObject = new \SplFileObject($this->filePath, 'r');
                }
            }
        }
    }

    /**
     * @return bool|string
     */
    public function tags()
    {

        $cache = $this->cache();

        if (!empty($cache)) {
            return $cache;
        }
        if ($this->page instanceof Page) {
            $tag = new Tag($this->page);
            $tags = $tag->show();
            $tag->save();
            return $tags;
        }
        return '';
    }

    public static function form(Model $model)
    {
        $page = Page::firstOrNew([
            'object' => $model::class,
            'object_id' => $model->getKey()
        ]);
        $keywordAnalysis = false;
        $metaTags = $page->pageLevel();
        $twitter = [];
        $og = [];

        if (isset($metaTags['og'])) {
            $og = $metaTags['og'];
            unset($metaTags['og']);
        }
        if (!empty($page->focus_keyword)) {
            $keyword = new KeywordAnalysis($page->path, $page->focus_keyword);
            $keywordAnalysis = $keyword->run()->result();
        }
        if (isset($metaTags['twitter'])) {
            $twitter = $metaTags['twitter'];
            unset($metaTags['twitter']);
        }
        return view('seo::includes.page_meta_tags', [
            'record' => $page,
            'og' => $og,
            'twitter' => $twitter,
            'metaTags' => $metaTags,
            'keywordAnalysis' => $keywordAnalysis
        ]);
    }

    /**
     * @param $url
     * @param array $data
     * @return Page
     */
    public static function save(Model $model, $url, $data = [])
    {
        try {
            $imageMeta = [];
            $images = [];
            $fillable = request()->get('page', []);

            if (isset($data['images'])) {
                $images = $data['images'];
                unset($data['images']);
            }

            $page = Page::firstOrNew([
                'object' => $model::class,
                'object_id' => $model->getKey()
            ]);

            $page->path = $url;
            $page->object = $model::class;
            $page->object_id = $model->getKey();

            foreach ($fillable as $column => $value) {
                if (empty($value) && isset($data[$column]) && !empty($data[$column])) {
                    $fillable[$column] = $data[$column];
                }
            }
            $page->fill($fillable);
            if ($page->save()) {
                if (!empty($images)) {

                    $page->destroyImages()->saveImagesFromArray($images);
                }
                $metaValues = request()->get('meta', []);

                $page->saveMeta($metaValues);

                $page->saveMeta(static::upload(request()->file('meta')));
                // Its time to refresh cache or making new cache
                $tag = new Tag($page);
                $tag->make()->save();
            }
            return $page;
        } catch (\Exception $e) {
            Log::error($e->getMessage() . 'on Line ' . $e->getLine() . ' in ' . $e->getFile());
        }
    }

    /**
     * @return bool|string
     */
    public function cache()
    {
        if ($this->splFileObject) {
            $modifiedTimeStamp = $this->splFileObject->getMTime();
            $cacheTime = config('seo.cache.expire', 1440);

            $currentTime = time();
            if (($modifiedTimeStamp + $cacheTime) > $currentTime) {
                return $this->splFileObject->fread($this->splFileObject->getSize());
            }
        } elseif (config('seo.cache.driver') == 'database' && is_object($this->page) && !empty($this->page->tags)) {

            return $this->page->tags;
        }
        return false;
    }

    /**
     * @param $metaImages
     * @param $model
     * @return array
     */
    public static function upload($metaImages, $model = '')
    {
        $imageMeta = [];

        $imageDriver = config('seo.storage.driver', 'public');
        $imagePrefix = config('seo.storage.prefix', 'storage');
        $imageFolder = config('seo.storage.folder', 'seo');
        if(!is_array($metaImages)) return $imageMeta;
        foreach ($metaImages as $id => $img) {
            $path = $img->store($imageFolder, $imageDriver);
            $imageSrc = asset($imagePrefix . '/' . $path);
            $imageMeta[$id] = $imageSrc;
            if ($model instanceof Page) {
                $pageImageModel = PageImage::firstOrCreate(['src' => $imageSrc, 'page_id' => $model->id]);
                $pageImageModel->title = $model->title;
                $pageImageModel->caption = $pageImageModel->title;
                $pageImageModel->save();
            }
        }
        return $imageMeta;
    }
}
