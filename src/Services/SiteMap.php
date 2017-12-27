<?php


namespace SEO\Services;

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
        $this->filePath = !empty($filePath) ? path_info($filePath, PATHINFO_DIRNAME) : public_path(config('seo.sitemap_location'));
    }

    /**
     * @return $this
     */
    public function image()
    {
        $template = __DIR__ . '/../../resources/assets/sitemap-image.xml';
        $this->simpleXml = simplexml_load_file($template);
        return $this;
    }

    /**
     * @return $this
     */
    public function page()
    {
        $template = __DIR__ . '/../../resources/assets/sitemap.xml';
        $this->simpleXml = simplexml_load_file($template);
        return $this;
    }

    public function xxx()
    {
        $this->total = Page::count();

        for ($page = 0; $page * $this->perPage < $this->total; $page++) {
            $pages = Page::where('robot_index', 'index')->take($this->perPage)->offset($page * $this->perPage)->get();
            $this->generate($pages, $page);
        }


    }

    /**
     * @param Collection $pages
     */
    protected function generate($pages, $pageNumber)
    {
        $siteMapTemplate = __DIR__ . '/../../resources/assets/sitemap.xml';
        $simpleXML = simplexml_load_file($siteMapTemplate);

        foreach ($pages as $page) {
            $url = $simpleXML->addChild('url');
            $this->singlePage($url, $page);
        }

        $filePath = $this->filePath . '/' . 'sitemap-' . $pageNumber . '.xml';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $simpleXML->saveXML($filePath);
    }

    /**
     * @param $url
     * @param $page
     */
    private function singlePage($url, $page)
    {
        $url->addChild('loc', $page->getFullUrl());
        $url->addChild('lastmod', $page->getLastModifiedDate());
        $url->addChild('changefreq', $page->getChangeFrequency());
        $url->addChild('priority', $page->getPriority());
    }

    /**
     * @param  \SimpleXMLElement $url
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
        $imageXml->addChild('image:loc', $image->getSrc(), static::ImageNs);
        $caption = $image->getCaption();
        $title = $image->getTitle();
        $location = $image->getLocation();

        if (!empty($caption)) {
            $imageXml->addChild('image:caption', $caption, static::ImageNs);
        }
        if (!empty($title)) {
            $imageXml->addChild('image:title', $title, static::ImageNs);
        }
        if (!empty($location)) {
            $imageXml->addChild('image:geo_location', $location, static::ImageNs);
        }
        return $imageXml;
    }

    public function save()
    {

    }
}