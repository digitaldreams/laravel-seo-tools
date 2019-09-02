<?php


namespace SEO\Services;

use Illuminate\Support\Facades\Log;
use SEO\Models\PageImage;
use SEO\Models\Setting;
use SEO\Models\Page;

class SiteMap
{
    const ImageNs = 'http://www.google.com/schemas/sitemap-image/1.1';
    protected $pages;
    protected $perPage;
    protected $total;
    protected $filePath;
    protected $simpleXml;

    /**
     * SiteMap constructor.
     * @param string $filePath
     * @param string $limit
     */
    public function __construct($filePath = '', $limit = '')
    {
        $pageLimit = !empty($limit) && is_int($limit) ? $limit : (new Setting())->getValueByKey('entries_per_sitemap');
        $this->perPage = !empty($pageLimit) ? $pageLimit : 1000;
        $this->filePath = !empty($filePath) ? path_info($filePath, PATHINFO_DIRNAME) : public_path(trim(config('seo.sitemap_location'), "/"));
    }

    /**
     * @return $this
     */
    protected function imageTemplate()
    {
        $template = __DIR__ . '/../../resources/assets/sitemap-image.xml';
        $this->simpleXml = simplexml_load_file($template);
        return $this;
    }

    /**
     * @return $this
     */
    protected function pageTemplate()
    {
        $template = __DIR__ . '/../../resources/assets/sitemap.xml';
        $this->simpleXml = simplexml_load_file($template);
        return $this;
    }

    /**
     *
     */
    public function page()
    {
        $this->total = Page::count();

        for ($page = 0; $page * $this->perPage < $this->total; $page++) {
            $this->pageTemplate();
            $pages = Page::where('robot_index', 'index')->take($this->perPage)->offset($page * $this->perPage)->get();
            $this->generatePage($pages, $page);
        }
        return $this;
    }

    /**
     * Page Generator
     *
     * @param Collection $pages
     */
    protected function generatePage($pages, $pageNumber)
    {
        foreach ($pages as $page) {
            $url = $this->simpleXml->addChild('url');
            $this->singlePage($url, $page);
        }
        $this->save('sitemap-pages-' . $pageNumber . '.xml');
    }

    /**
     * @param $url
     * @param $page
     * @return mixed
     */
    private function singlePage($url, $page)
    {
        try {
            $url->addChild('loc', $page->getFullUrl());
            $url->addChild('lastmod', $page->getLastModifiedDate());
            $url->addChild('changefreq', $page->getChangeFrequency());
            $url->addChild('priority', $page->getPriority());
            foreach ($page->pageImages as $image) {
                $imageXml = $url->addChild('image:image', '', static::ImageNs);
                $this->singleImage($imageXml, $image);
            }
            return $url;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $url;
        }
    }

    /**
     * Page Image generator
     */
    public function image()
    {
        $this->total = Page::count();
        for ($p = 0; $p * $this->perPage < $this->total; $p++) {
            $this->imageTemplate();
            $pages = Page::where('robot_index', 'index')->take($this->perPage)->offset($p * $this->perPage)->get();
            foreach ($pages as $page) {
                $url = $this->simpleXml->addChild('url');
                $this->pageImages($url, $page);
            }
            $this->save('sitemap-images-' . $p . '.xml');
        }
        return $this;
    }

    /**
     * @param \SimpleXMLElement $url
     * @param Page $page
     */
    protected function pageImages($url, $page)
    {
        $url->addChild('loc', $page->getFullUrl());
        foreach ($page->pageImages as $image) {
            $imageXml = $url->addChild('image:image', '', static::ImageNs);
            $this->singleImage($imageXml, $image);
        }
    }

    /**
     * @param \SimpleXMLElement $imageXml
     * @param PageImage $image
     * @return \SimpleXMLElement
     */
    protected function singleImage($imageXml, $image)
    {
        try {
            $imageXml->addChild('image:loc', $image->getFullUrl(), static::ImageNs);
            $caption = $image->getCaption();
            $title = $image->getTitle();
            $location = $image->getLocation();

            if (!empty($caption)) {
                $imageXml->addChild('image:caption', htmlspecialchars($caption), static::ImageNs);
            }
            if (!empty($title)) {
                $imageXml->addChild('image:title', htmlspecialchars($title), static::ImageNs);
            }
            if (!empty($location)) {
                $imageXml->addChild('image:geo_location', htmlspecialchars($location), static::ImageNs);
            }
            return $imageXml;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $imageXml;
        }
    }

    /**
     * @param $fileName
     */
    protected function save($fileName)
    {
        $filePath = $this->filePath . '/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $this->simpleXml->saveXML($filePath);
    }

    public function all()
    {
        $files = [];
        $xmlDir = public_path(config('seo.sitemap_location'));
        if (!file_exists($xmlDir)) {
            mkdir($xmlDir);
        }
        $dirIt = new \DirectoryIterator($this->filePath);
        foreach ($dirIt as $file) {
            if ($file->isDot()) continue;
            if ($file->getExtension() != 'xml') continue;
            $files[] = asset(trim(config('seo.sitemap_location'), "/") . '/' . $file->getBasename());
        }
        return $files;
    }

    /**
     *
     */
    public function mergeIntoOne()
    {
        $template = __DIR__ . '/../../resources/assets/sitemap-group.xml';
        $groupXml = simplexml_load_file($template);
        $files = $this->all();
        foreach ($files as $file) {
            $sitemap = $groupXml->addChild('sitemap');
            $sitemap->addChild('loc', $file);
            $sitemap->addChild('lastmod', date('Y-m-d'));
        }
        $filePath = $this->filePath . '/sitemap.xml';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $groupXml->saveXML($filePath);
        return $this;
    }

    public function destroyAll()
    {
        $dirIt = new \DirectoryIterator($this->filePath);
        foreach ($dirIt as $file) {
            if ($file->isDot()) continue;
            if ($file->getExtension() != 'xml') continue;
            unlink($file->getRealPath());
        }
        return $this;
    }
}