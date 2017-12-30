<?php

namespace SEO\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SEO\Models\Page;
use SEO\Models\PageImage;
use SEO\Models\Setting;
use SEO\Contracts\LinkProvider;

class PageGeneratorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $linkProviders = config('seo.linkProviders', []);
        $total = 0;

        foreach ($linkProviders as $linkProvider) {

            $obj = new $linkProvider;
            if ($obj instanceof LinkProvider) {
                $links = $obj->all();

                foreach ($links as $link) {
                    $page = $this->page($link);

                    if ($page->save()) {
                        $total++;
                        PageImage::where('page_id', $page->id)->delete();

                        if (isset($link['images']) && !empty($link['images']) && is_array($link['images'])) {
                            $this->pageImage($page, $link['images']);
                        }
                    }
                }
            }
        }
    }

    /**
     * @param Page $page
     * @param  array $images
     */
    protected function pageImage($page, $images)
    {
        foreach ($images as $image) {
            if (is_array($image)) {
                if (!isset($image['src'])) {
                    continue;
                }
                $pageImage = PageImage::create(['src' => $image['src'], 'page_id' => $page->id]);

                if (isset($image['title'])) {
                    $pageImage->title = $image['title'];
                }
                if (isset($image['caption'])) {
                    $pageImage->caption = $image['caption'];

                }
                if (isset($image['location'])) {
                    $pageImage->location = $image['location'];
                }

            } else {
                PageImage::create(['src' => $image, 'page_id' => $page->id]);
            }
        }
    }

    /**
     * @param $link
     * @return Page
     */
    protected function page($link)
    {
        $setting = new Setting();

        $changeFrequency = $setting->getValueByKey('page_changefreq');
        $priority = $setting->getValueByKey('page_priority');

        $path = $link['link'];
        $object = isset($link['object']) ? $link['object'] : null;
        $objectId = isset($link['object_id']) ? $link['object_id'] : null;
        $page = Page::firstOrNew(['object' => $object, 'object_id' => $objectId]);

        $page->path = $path;
        $page->canonical_url = $path;
        $page->title_source = isset($link['title']) ? substr($link['title'], 0, 70) : '';
        $page->description_source = isset($link['description']) ? substr($link['description'], 0, 150) : '';

        $page->created_at = isset($link['created_at']) ? $link['created_at'] : '';
        $page->updated_at = isset($link['updated_at']) ? $link['updated_at'] : '';
        $page->change_frequency = !empty($changeFrequency) ? $changeFrequency : 'monthly';
        $page->priority = (!empty($priority) && $priority < 1.1) ? $priority : 0.5;

        return $page;
    }
}
