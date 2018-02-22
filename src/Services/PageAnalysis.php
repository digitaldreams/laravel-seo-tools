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

    public function __construct($url, $keyword = '')
    {
        $fullUrl = $url;
        $content = @file_get_contents($fullUrl);

        if ($content) {
            $this->success = true;
            $this->dom = @new \DOMDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $this->dom->loadHTML($content);
            $this->xpath = new \DOMXpath($this->dom);
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

    public function headings(array $list = ['h1', 'h2', 'h3'])
    {
        $ret = [];

        foreach ($list as $level) {
            $ret[$level] = $this->heading($level);
        }
        return $ret;
    }

    /**
     * @return array
     */
    public function anchor()
    {
        $links = [];
        $tags = $this->dom->getElementsByTagName('a');

        foreach ($tags as $tag) {
            $link = [];
            foreach ($tag->attributes as $attr) {

                if ($attr->name == 'href') {
                    $link['href'] = $attr->nodeValue;
                    $link['internal'] = $this->isInternal($attr->nodeValue);
                    $link['exists'] = $this->fileExists($attr->nodeValue);
                } else {
                    $link[$attr->name] = $attr->nodeValue;
                }
            }
            $link['text']=trim($tag->nodeValue);
            $links[] = $link;
        }
        return $links;
    }

    /**
     * @param $url
     * @return bool
     */
    protected function fileExists($url)
    {
        $file_headers = @get_headers($url);
        return $file_headers[0] == 'HTTP/1.1 404 Not Found' ? false : true;
    }

    /**
     * @param $url
     * @return bool
     */
    public function isInternal($url)
    {
        return parse_url($url, PHP_URL_HOST) == parse_url(url('/'), PHP_URL_HOST);
    }

    /**
     * @param bool $size
     * @return array
     */
    public function images($size = true)
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
                    $info = @getimagesize($mg['src']);
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

    public function css()
    {
        $css = $this->xpath->query("*/link[@rel='stylesheet']");
        return $this->jscss($css, 'href');
    }

    /**
     * @param bool $size
     * @return array
     */
    public function js($size = true)
    {
        $scripts = $this->dom->getElementsByTagName("script");
        return $this->jscss($scripts, 'src');
    }

    protected function jscss($files, $attrName, $size = true)
    {
        $retFiles = [];

        foreach ($files as $file) {
            foreach ($file->attributes as $attr) {
                if ($attr->name == $attrName) {
                    $retFiles[] = [
                        $attrName => $attr->nodeValue,
                        'size' => !empty($size) ? round(Helper::fileSize($attr->nodeValue) / 1000) : null
                    ];
                }
            }

        }
        return $retFiles;
    }

    /**
     * @param $level
     * @return array
     */
    protected function heading($level)
    {
        $ret = [];
        $headings = $this->dom->getElementsByTagName($level);
        foreach ($headings as $heading) {
            $ret[] = $heading->nodeValue;
        }
        return $ret;
    }

}