<?php
/**
 * User: Tuhin
 * Date: 12/30/2017
 * Time: 2:36 PM
 */

namespace SEO;


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

        if($this->page){
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
}