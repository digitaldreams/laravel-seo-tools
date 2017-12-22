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

class DashboardController
{
    public function index(Request $request)
    {
        $data = [
            'page_total' => Page::count(),
            'meta_tag_total' => MetaTag::count(),
            'setting_total' => Setting::count()
        ];
        return view('seo::pages.dashboard.index', $data);
    }
}