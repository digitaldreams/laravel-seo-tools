<?php
/**
 * User: Tuhin
 * Date: 2/21/2018
 * Time: 11:16 PM
 */

namespace SEO\Services;


use Illuminate\Support\Facades\Cache;
use SEO\Models\Page;
use SEO\Services\Helper;

class PageAnalysis
{

    /**
     * @var string HTML Tags
     */
    protected $htmlContent;

    /**
     * @var
     */
    protected $textContent;

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

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var
     */
    protected $url;

    protected $resourceSize = 0;

    /**
     * PageAnalysis constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->htmlContent = @file_get_contents($this->url);

        if ($this->htmlContent) {
            $this->success = true;
            $this->dom = @new \DOMDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $this->dom->loadHTML($this->htmlContent);
            $this->xpath = new \DOMXpath($this->dom);
            libxml_clear_errors();
        }

    }

    /**
     *
     * @return bool
     */
    public function isSuccess()
    {
        return (bool)$this->success;
    }

    /**
     * @param bool $size
     * @return $this
     */
    public function fetch($size = true)
    {
        $this->data['title'] = $this->title();
        $this->data['metas'] = $this->metaTags();
        $this->data['headings'] = $this->headings();
        $this->data['images'] = $this->images($size);
        $this->data['anchors'] = $this->anchor();
        $this->data['css'] = $this->css($size);
        $this->data['js'] = $this->js($size);

        $pageSize = mb_strlen($this->htmlContent, 'utf8');
        $this->data['size'] = round($this->resourceSize + ($pageSize / 1000));

        return $this;
    }

    /**
     * @param int $minutes
     * @return $this
     * @throws \Exception
     */
    public function save($minutes = 30)
    {
        cache([$this->url => json_encode($this->data, JSON_UNESCAPED_SLASHES)], now()->addMinutes($minutes));
        return $this;
    }

    /**
     * Try to get result from cache if exists otherwise run fetch
     * @return PageAnalysis
     */
    public function fromCache()
    {
        if (Cache::has($this->url)) {
            $this->data = json_decode(Cache::get($this->url), true);
        } else {
            $this->fetch();
        }
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    public function title()
    {
        $title = $this->dom->getElementsByTagName('title');
        return $title->length > 0 ? $title->item(0)->nodeValue : null;
    }

    /**
     * @return array
     */
    public function metaTags()
    {
        $retArr = [];
        $tags = $this->dom->getElementsByTagName("meta");

        foreach ($tags as $key => $tag) {
            $meta = [];
            foreach ($tag->attributes as $attr) {
                if ($attr->name == 'property') {
                    $key = '@' . $attr->nodeValue;
                } elseif ($attr->name == 'name') {
                    $key = $attr->nodeValue;
                }
                $meta[$attr->name] = $attr->nodeValue;
            }
            $retArr[$key] = $meta;
        }
        return $retArr;
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
                    $link['exists'] = null;
                } else {
                    $link[$attr->name] = $attr->nodeValue;
                }
            }
            $link['text'] = trim($tag->nodeValue);
            $links[] = $link;
        }
        return $links;
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
                            $sizeKb = round(Helper::fileSize($mg['src']) / 1000);
                            $this->resourceSize += $sizeKb;
                            $mg['size'] = $sizeKb;

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
                    $sizeKb = !empty($size) ? round(Helper::fileSize($attr->nodeValue) / 1000) : null;
                    if ($size) {
                        $this->resourceSize += $sizeKb;
                    }
                    $retFiles[] = [
                        $attrName => $attr->nodeValue,
                        'size' => $sizeKb
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

    /**
     * @param $url
     * @return bool
     */
    protected function fileExists($url)
    {
        $file_headers = @get_headers($url);
        return $file_headers[0] == 'HTTP/1.1 404 Not Found' ? false : true;
    }
}