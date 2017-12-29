<?php
/**
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
use SEO\Services\SiteMap;


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
        $siteMap = new SiteMap();
        $siteMap->page()->image();
    }

}