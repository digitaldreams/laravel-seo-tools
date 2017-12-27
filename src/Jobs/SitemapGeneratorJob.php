<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 12/27/2017
 * Time: 4:08 PM
 */

namespace SEO\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SEO\Models\Page;
use SEO\Models\Setting;


class SitemapGeneratorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * SitemapGeneratorJob constructor.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pageLimit = (new Setting())->getValueByKey('entries_per_sitemap');
        $perPage = !empty($pageLimit) ? $pageLimit : 1000;
        $page = 0;
        $totalResult = Page::count();
        for ($page = 0; $page * $perPage < $totalResult; $page++) {
            $pages = Page::where('robot_index', 'index')->take($perPage)->offset($page * $perPage)->get();
            $this->generate($pages, $page);
        }
    }

}