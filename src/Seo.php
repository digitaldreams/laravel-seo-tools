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
        $this->page = Page::whereIn('path', [trim($path, "/"), "/" . $path, url($path)])->first();

        if ($this->page) {
            $this->filePath = rtrim(config('seo.cache.storage'), "/") . '/' . $this->page->id . '.html';

            if (file_exists($this->filePath)) {
                $this->splFileObject = new \SplFileObject($this->filePath, 'r');
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
            'object' => get_class($model),
            'object_id' => $model->getKey()
        ]);

        $metaTags = $page->pageLevel();

        if (isset($metaTags['og'])) {
            $og = $metaTags['og'];
            unset($metaTags['og']);
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
        ]);
    }

    /**
     * @param Model $model
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
                'object' => get_class($model),
                'object_id' => $model->getKey()
            ]);

            $page->path = $url;
            $page->object = get_class($model);
            $page->object_id = $model->getKey();

            foreach ($fillable as $column => $value) {
                if (empty($value) && isset($data[$column]) && !empty($data[$column])) {
                    $fillable[$column] = $data[$column];
                }
            }
            $page->fill($fillable);
            if ($page->save()) {
                if (!empty($images)) {

                    $page->saveImagesFromArray($images);
                }
                $metaValues = request()->get('meta', []);

                $page->saveMeta($metaValues);

                $page->saveMeta(static::upload(request()->file('meta')));
            }
            return $page;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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
        }
        return false;
    }

    /**
     * @param $files
     * @return array
     */
    public static function upload($files)
    {
        $imageMeta = [];
        $metaImages = request()->file('meta');

        $imageDriver = config('seo.storage.driver', 'public');
        $imagePrefix = config('seo.storage.prefix', 'storage');
        $imageFolder = config('seo.storage.folder', 'seo');

        foreach ($metaImages as $id => $img) {
            $path = $img->store($imageFolder, $imageDriver);
            $imageMeta[$id] = asset($imagePrefix . '/' . $path);
        }
        return $imageMeta;
    }
}