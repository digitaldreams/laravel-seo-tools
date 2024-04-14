<?php
/**
 * User: Tuhin
 * Date: 12/22/2017
 * Time: 10:30 PM
 */

namespace SEO;


use Illuminate\Http\Request;
use SEO\Models\MetaTag;
use SEO\Models\Page;
use SEO\Models\Setting;
use SEO\Services\SchemaBuilder;

/**
 * Class Tag
 * @package SEO
 */
class Tag
{
    /**
     * @var Page
     */
    public $page;

    /**
     * @var array
     */
    protected $tags = [];

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * @var Setting
     */
    protected $setting;

    /**
     * @var array
     */
    protected static $map = [
        'name' => [
            'twitter:image' => 'twitter_default_image',
        ],
        'property' => [

            'og:image' => 'facebook_default_image'
        ]
    ];

    /**
     * @var array
     */
    protected $globalGroups = ['og', 'twitter', 'article', 'webmaster'];

    /**
     * Tag constructor.
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->setting = new Setting();
        $this->makeMeta();
    }

    /**
     * Create all meta tags that are saved in pages table row.
     */
    protected function pageLevel()
    {
        $siteTitle = $this->setting->getValueByKey('site_title');
        if (!empty($siteTitle)) {
            $siteTitle = ' | ' . $siteTitle;
        }
        $this->tags[] = '<title>' . $this->page->getTitle() . $siteTitle . '</title>';
        $this->tags[] = '<link rel="canonical" href="' . $this->page->getCanonical() . '" />';
        $description = $this->page->getDescription();
        if (!empty($description)) {
            $this->tags[] = '<meta name="description" content="' . $description . '" />';
        }
        return $this;
    }

    /**
     * @return $this
     */
    protected function robots()
    {
        $roboxIndex = $this->setting->getValueByKey('robot_index');
        $roboxFollow = $this->setting->getValueByKey('robot_follow');

        $pageIndex = ($roboxIndex == 'noindex') ? 'noindex' : $this->page->robot_index;
        $pageFollow = ($roboxFollow == 'nofollow') ? 'nofollow' : $this->page->robot_follow;

        $pageIndex = empty($pageIndex) ? $roboxIndex : $pageIndex;
        $pageFollow = empty($pageFollow) ? $roboxFollow : $pageFollow;

        $this->tags[] = '<meta name="robots" content="' . $pageIndex . ',' . $pageFollow . '" />';
        return $this;
    }

    /**
     * Generate webmaster validation meta tags
     * @return $this
     */
    protected function webmaster()
    {
        $webmaster_tools = $this->meta['webmaster_tools'] ?? [];
        $this->generator($webmaster_tools);
        return $this;
    }

    /**
     * Show Open Graph Tags
     * @return $this
     */
    protected function og()
    {
        $og = $this->meta['og'] ?? [];
        $article = $this->meta['article'] ?? [];
        $og = array_merge($og, $article);
        $this->generator($og);

        return $this;
    }

    /**
     * Show Twitter Meta Tags
     * @return $this
     */
    protected function twitter()
    {
        $twitter = $this->meta['twitter'] ?? [];
        $this->generator($twitter);
        return $this;
    }

    /**
     * Show custom meta tags
     * @return $this
     */
    protected function otherTags()
    {
        foreach ($this->meta as $group => $tags) {
            if (!in_array($group, $this->globalGroups)) {
                $this->generator($tags);
            }
        }
        return $this;
    }

    public function schemaJsonLd()
    {
        $script = '';
        $json = (new SchemaBuilder())->ownership();
        if (!empty($json)) {
            $script = '<script type="application/ld+json">' . PHP_EOL;
            $script .= $json . PHP_EOL;
            $script .= '</script>';
        }
        if (!empty($this->page->schema)) {
            $script .= PHP_EOL . '<script type="application/ld+json">' . PHP_EOL;
            $script .= $this->page->schema . PHP_EOL;
            $script .= '</script>' . PHP_EOL;
        }
        return $script;
    }


    /**
     * Show tags array into html string
     * @return string
     */
    public function asHtml()
    {
        $metaHtml = implode("\n", $this->tags);
        $metaHtml .= PHP_EOL . $this->schemaJsonLd() . PHP_EOL;
        return $metaHtml;
    }

    /**
     * Generate meta tags adn save them into tags array
     * @return $this
     */
    public function make()
    {
        $this->makeMeta();
        $this->robots()->webmaster()->pageLevel()->og()->twitter()->otherTags();
        return $this;
    }

    /**
     * For outside. It will make meta tags and then return as html string.
     */
    public function show()
    {
        if ($this->hasPage()) {
            return $this->make()->asHtml();
        }
    }

    /**
     * Save html into storage
     */
    public function save()
    {
        $cache = config('seo.cache');
        if (!isset($cache['enable']) || $cache['enable'] == false) {
            return null;
        }
        $html = $this->asHtml();
        if (config('seo.cache.storage') == 'file') {
            $dir = rtrim((string) $cache['storage'], "/");
            if (!file_exists($dir)) {
                mkdir($dir);
            }

            $filePath = $dir . '/' . $this->page->id . '.html';
            $splFile = new \SplFileObject($filePath, 'w+');
            $splFile->fwrite($html);
            $splFile->fflush();
            return $splFile->getFilename();
        } else {
            $this->page->tags = $html;
            $this->page->save();
        }
    }

    /**
     * Check has this path has a seo page. If so return true or false
     * @return bool
     */
    public function hasPage()
    {
        return $this->page instanceof Page;
    }

    /**
     * Normalize meta tags with content
     * @return array
     */
    protected function makeMeta()
    {
        if (!$this->hasPage()) {
            return [];
        }
        $pageMeta = $this->page->metaTags();
        $globalMeta = MetaTag::withContent('', 'global');

        foreach ($pageMeta as $group => $tags) {
            foreach ($tags as $tag) {
                $this->meta[$group][$tag->id] = $tag;
            }
        }
        foreach ($globalMeta as $meta) {
            if (!empty($meta->group)) {
                $this->meta[$meta->group][$meta->id] = $meta;
            } elseif ($meta->visibility == 'global') {
                $this->meta['global'][$meta->id] = $meta;
            } elseif ($meta->visibility == 'page') {
                $this->meta['page'][$meta->id] = $meta;
            } else {
                $this->meta['others'][$meta->id] = $meta;
            }
        }
        return $this->meta;
    }

    /**
     * @param $tags
     * @return $this
     */
    protected function generator($tags)
    {
        foreach ($tags as $tag) {
            $tag = $this->assignDefaultValueFromSettings($tag);
            if (!empty($tag->content)) {
                if (!empty($tag->name)) {
                    $this->tags[] = '<meta name="' . $tag->name . '" content="' . $tag->content . '" />';

                } elseif (!empty($tag->name) && !empty($tag->property)) {
                    $this->tags[] = '<meta name="' . $tag->name . '" property="' . $tag->property . '" content="' . $tag->content . '" />';
                } else {
                    $this->tags[] = '<meta property="' . $tag->property . '" content="' . $tag->content . '" />';
                }
            }
        }
        return $this;
    }

    protected function assignDefaultValueFromSettings($meta)
    {
        $settingModel = new Setting();
        if (empty($meta->content)) {
            $fieldMap = static::$map;
            if (!empty($meta->name) && isset($fieldMap['name'][$meta->name])) {
                $settingKeyName = $fieldMap['name'][$meta->name];
            } elseif (!empty($meta->property) && isset($fieldMap['property'][$meta->property])) {
                $settingKeyName = $fieldMap['property'][$meta->property];
            }

            if (!empty($settingKeyName)) {
                $value = $settingModel->getValueByKey($settingKeyName);
                if (!empty($value)) {
                    $meta->content = $value;
                }
            }
        }
        return $meta;
    }
}