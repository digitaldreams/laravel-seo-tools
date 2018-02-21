<?php
/**
 * User: Tuhin
 * Date: 2/21/2018
 * Time: 11:16 PM
 */

namespace SEO\Services;


use SEO\Models\Page;
use SEO\Services\Helper;

class PageAnalysis
{
    /**
     * @var Page
     */
    protected $page;
    /**
     * @var
     */
    protected $htmlContent;
    /**
     * @var
     */
    protected $textConent;

    /**
     * @var
     */
    protected $success = false;

    /**
     * @var \DOMDocument
     */
    protected $dom;

    /**
     * @var \DOMXpath
     */
    protected $xpath;

    public function __construct(Page $page, $keyword = '')
    {
        $this->page = $page;
        $fullUrl = $this->page->getFullUrl();
        $content = @file_get_contents($fullUrl);

        if ($content) {
            $this->success = true;
            $this->dom = @new \DOMDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $this->dom->loadHTML($content);
            $xpath = new \DOMXpath($this->dom);
            libxml_clear_errors();
        }

    }

    /**
     *
     * @return bool
     */
    public function isSuccss()
    {
        return (bool)$this->success;
    }

    public function report()
    {

    }

    public function density()
    {

    }

    public function warnings()
    {

    }

    public function good()
    {

    }

    /**
     *
     */
    public function save()
    {

    }

    /**
     * @return array
     */
    public function toArray()
    {

    }

    /**
     * @param bool $size
     * @return array
     */
    public function fetchImages($size = true)
    {
        $imgs = [];
        $retImgs = [];
        $images = $this->dom->getElementsByTagName('img');

        if ($images->length > 0) {
            foreach ($images as $image) {
                $img = [];
                foreach ($image->attributes as $attr) {
                    $img[$attr->name] = $attr->nodeValue;
                }
                $imgs[] = $img;
            }
            foreach ($imgs as $mg) {
                $mg['width'] = '';
                $mg['height'] = '';
                $mg['mime'] = '';
                if (isset($mg['src']) && !empty($mg['src'])) {
                    $info = @getimagesize($image['src']);
                    if (!empty($info)) {
                        $mg['width'] = isset($info[0]) ? $info[0] : '';
                        $mg['height'] = isset($info[1]) ? $info[1] : '';
                        $mg['mime'] = isset($info['mime']) ? $info['mime'] : '';

                        if ($size) {
                            $mg['size'] = round(Helper::fileSize($mg['src']) / 1000);
                        }
                    }
                }
                $retImgs[] = $mg;
            }
        }
        return $retImgs;
    }

}