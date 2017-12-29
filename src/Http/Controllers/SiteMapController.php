<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 12/29/2017
 * Time: 6:53 PM
 */

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use SEO\Jobs\SitemapGeneratorJob;

class SiteMapController extends Controller
{
    public function store()
    {
        dispatch(new SitemapGeneratorJob());
        return redirect()->back()->with(config('seo.flash_message'), 'Your request for generating sitemap are in queue now.');
    }
}