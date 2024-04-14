<?php

namespace SEO\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use DataConverter\FileManager;
use SEO\Models\Page;
use SEO\Models\PageImage;
class PageUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filters = [
        'id',
        'path',
        'object',
        'object_id',
        'robot_index',
        'robot_follow',
        'canonical_url',
        'title',
        'title_source',
        'description',
        'description_source',
        'images'
    ];

    /**
     * Create a new job instance.
     *
     * @param $filePath
     */
    public function __construct(protected $filePath)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileManager = FileManager::initByFileType($this->filePath);
        $pages = $fileManager->config(['first_row_as_headline' => true])->read()->makeAssoc()->filter($this->filters)->getData();

        foreach ($pages as $page) {
            $images = [];
            if (isset($page['id'])) {
                $model = Page::find($page['id']);
            } elseif (isset($page['path'])) {
                $model = Page::whereIn('path', [trim((string) $page['path'], "/"), "/" . trim((string) $page['path'], "/"), url($page['path'])])->first();
            }
            if (!$model) {
                $model = new Page();
            }
            if (isset($page['images'])) {
                $images = $page['images'];
                unset($page['images']);
            }
            if ($model->fill($page)->save()) {
                if (!empty($images)) {
                    if (strripos((string) $images, "|") !== false) {
                        $images = explode("|", (string) $images);
                    } else {
                        $images = [$images];
                    }
                }
                foreach ($images as $image) {
                    PageImage::create([
                        'src' => $image,
                        'page_id' => $model->id
                    ]);
                }
            }

        }
    }
}
