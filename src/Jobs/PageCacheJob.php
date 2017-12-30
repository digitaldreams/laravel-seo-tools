<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 12/30/2017
 * Time: 3:59 PM
 */

namespace SEO\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SEO\Models\Page;
use SEO\Tag;

class PageCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * PageCacheJob constructor.
     */
    public function __construct()
    {

    }

    /**
     *Execute the job
     */
    public function handle()
    {
        $pages = Page::where('robot_index', 'index')->get();

        foreach ($pages as $page) {
            $tag = new Tag($page);
            $tag->make()->save();
        }
    }

}