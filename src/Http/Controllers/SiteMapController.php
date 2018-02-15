<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 12/29/2017
 * Time: 6:53 PM
 */

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use SEO\Http\Requests\SiteMaps\Update;
use SEO\Jobs\SitemapGeneratorJob;
use SEO\Models\Page;

class SiteMapController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('seo::pages.sitemap.index', [
            'pages' => Page::where('robot_index', 'index')->paginate(15)
        ]);
    }

    /**
     *
     */
    public function update(Update $update)
    {
        $mit = new \MultipleIterator(\MultipleIterator::MIT_KEYS_ASSOC);
        $mit->attachIterator(new \ArrayIterator($update->get('page_id')), "id");
        $mit->attachIterator(new \ArrayIterator($update->get('change_frequency')), "change_frequency");
        $mit->attachIterator(new \ArrayIterator($update->get('priority')), "priority");

        foreach ($mit as $page) {
            $pageModel = Page::find($page['id']);

            if ($pageModel) {
                $pageModel->change_frequency = $page['change_frequency'];
                $pageModel->priority = $page['priority'];
                $pageModel->save();
            }
        }
        return redirect()->back()->with(config('seo.flash_message'), 'Site Map settings saved successfully');
    }

    public function store()
    {
        dispatch(new SitemapGeneratorJob());
        return redirect()->back()->with(config('seo.flash_message'), 'Your request for generating sitemap are in queue now.');
    }
}