<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 12/22/2017
 * Time: 8:52 PM
 */

namespace SEO\Http\Controllers;


use Illuminate\Http\Request;
use SEO\Models\MetaTag;
use SEO\Models\Page;
use SEO\Models\Setting;
use SEO\Services\SiteMap;

class DashboardController
{
    public function index(Request $request)
    {
        $metaTags = MetaTag::withGroupBy('', 'global');

        $data = [
            'records' => Setting::paginate(10),
            'model' => new Setting(),
            'page_total' => Page::count(),
            'meta_tag_total' => MetaTag::count(),
            'setting_total' => Setting::count(),
            'webmasterTags' => isset($metaTags['webmaster_tools']) ? $metaTags['webmaster_tools'] : []
        ];
        return view('seo::pages.dashboard.index', $data);
    }

    /**
     * Manage Social Media
     */
    public function social()
    {
        $metaTags = MetaTag::withGroupBy('', 'global');
        $data = [
            'records' => Setting::paginate(10),
            'og' => $metaTags['og'],
            'twitter' => $metaTags['twitter'],
            'model' => new Setting(),
        ];
        return view('seo::pages.dashboard.social', $data);
    }

    /**
     * Manage Site map
     */
    public function sitemap()
    {
        $data = [
            'pages' => Page::where('robot_index', 'index')->paginate(15),
            'sitemaps' => (new SiteMap())->all()
        ];
        return view('seo::pages.dashboard.sitemap', $data);
    }

    /**
     *  Import Export and Download Pages
     */
    public function tools()
    {
        $data = [];
        return view('seo::pages.dashboard.tools', $data);
    }

    /**
     *
     */
    public function advanced()
    {
        $data = [];
        return view('seo::pages.dashboard.advanced', $data);
    }
}