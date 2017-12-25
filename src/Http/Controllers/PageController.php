<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use DataConverter\FileCsv;
use DataConverter\FileManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SEO\Contracts\LinkProvider;
use SEO\Http\Requests\Pages\Create;
use SEO\Http\Requests\Pages\Destroy;
use SEO\Http\Requests\Pages\Download;
use SEO\Http\Requests\Pages\Edit;
use SEO\Http\Requests\Pages\Image;
use SEO\Http\Requests\Pages\Index;
use SEO\Http\Requests\Pages\Show;
use SEO\Http\Requests\Pages\Store;
use SEO\Http\Requests\Pages\Update;
use SEO\Http\Requests\Pages\Upload;
use SEO\Models\Page;
use SEO\Models\PageImage;
use SEO\Models\PageMetaTag;

/**
 * Description of PageController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Index $request
     * @return Response
     */
    public function index(Index $request)
    {
        return view('seo::pages.pages.index', ['records' => Page::withCount(['pageImages'])->paginate(10)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Show $request
     * @param  Page $page
     * @return Response
     */
    public function show(Show $request, Page $page)
    {
        return view('seo::pages.pages.show', [
            'record' => $page,
            'metaTags' => $page->metaTags()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Create $request
     * @return Response
     */
    public function create(Create $request)
    {
        return view('seo::pages.pages.create', [
            'model' => new Page,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store $request
     * @return Response
     */
    public function store(Store $request)
    {
        $model = new Page;
        $model->fill($request->all());

        if ($model->save()) {
            session()->flash(config('seo.flash_message'), 'Page saved successfully');
            return redirect()->route('seo::pages.index');
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while saving Page');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edit $request
     * @param  Page $page
     * @return Response
     */
    public function edit(Edit $request, Page $page)
    {
        return view('seo::pages.pages.edit', [
            'model' => $page,
            'metaTags' => $page->metaTags()
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Request $request
     * @param  Page $page
     * @return Response
     */
    public function update(Update $request, Page $page)
    {
        $page->fill($request->all());

        if ($page->save()) {
            session()->flash(config('seo.flash_message'), 'Page successfully updated');
            return redirect()->route('seo::pages.index');
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while updating Page');
        }
        return redirect()->back();
    }

    /**
     * Delete a  resource from  storage.
     *
     * @param  Request $request
     * @param  Page $page
     * @return Response
     * @throws \Exception
     */
    public function destroy(Destroy $request, Page $page)
    {
        if ($page->delete()) {
            session()->flash(config('seo.flash_message'), 'Page successfully deleted');
        } else {
            session()->flash(config('seo.flash_error'), 'Error occurred while deleting Page');
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate(Request $request)
    {
        $linkProviders = config('seo.linkProviders', []);
        $total = 0;
        foreach ($linkProviders as $linkProvider) {

            $obj = new $linkProvider;
            if ($obj instanceof LinkProvider) {
                $links = $obj->all();

                foreach ($links as $link) {
                    $path = parse_url($link['link'], PHP_URL_PATH);
                    $page = Page::firstOrNew(['object' => $link['object'], 'id' => $link['id']]);

                    $page->path = $path;
                    $page->canonical_url = $path;
                    $page->title_source = isset($link['title']) ? $link['title'] : '';
                    $page->description_source = isset($link['description']) ? $link['description'] : '';
                    $page->title_source = isset($link['title']) ? $link['title'] : '';
                    $page->created_at = isset($link['created_at']) ? $link['created_at'] : '';
                    $page->updated_at = isset($link['updated_at']) ? $link['updated_at'] : '';

                    if ($page->save()) {
                        $total++;
                        PageImage::where('page_id', $page->id)->delete();

                        if (isset($link['images']) && !empty($link['images']) && is_array($link['images'])) {
                            foreach ($link['images'] as $image) {
                                PageImage::create(['src' => $image, 'page_id' => $page->id]);
                            }
                        }
                    }
                }
            }
        }
        return redirect()->route('seo::pages.index')->with(config('seo.flash_message'), $total . ' Pages saved successfully');
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function meta(Request $request, Page $page)
    {
        return view('seo::pages.pages.meta_tags', [
            'record' => $page,
            'metaTags' => $page->metaTags()
        ]);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveMeta(Request $request, Page $page)
    {
        $metaValues = $request->get('meta', []);
        foreach ($metaValues as $id => $content) {
            $pageMeta = PageMetaTag::firstOrCreate(['seo_page_id' => $page->id, 'seo_meta_tag_id' => $id]);
            $pageMeta->content = $content;
            $pageMeta->save();
        }
        return redirect()->back()->with(config('seo.flash_message'), 'Page meta tags saved successfully');
    }

    /**
     * Upload pages from csv,excel
     * @param Upload $upload
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Upload $upload)
    {
        $totalPage = 0;
        if ($upload->hasFile('file') && $upload->file('file')->isValid()) {
            $filePath = $upload->file('file')->store('pages', 'public');
            $fullPath = storage_path("app/public/" . $filePath);

            if (file_exists($fullPath)) {
                $fileManager = FileManager::initByFileType($fullPath);
                $pages = $fileManager->config([
                    'first_row_as_headline' => true,
                ])->read()->makeAssoc()->filter([
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
                ])->getData();

                foreach ($pages as $page) {
                    $images = [];
                    if (isset($page['id'])) {
                        $model = Page::find($page['id']);
                    } elseif (isset($page['path'])) {
                        $model = Page::whereIn('path', [trim($page['path'], "/"), "/" . trim($page['path'], "/"), url($page['path'])])->first();
                    }
                    if (!$model) {
                        $model = new Page();
                    }
                    if (isset($page['images'])) {
                        $images = $page['images'];
                        unset($page['images']);
                    }
                    if ($model->fill($page)->save()) {
                        $totalPage++;
                        if (!empty($images)) {
                            if (strripos($images, "|") !== false) {
                                $images = explode("|", $images);
                            } else {
                                $images = [$images];
                            }
                        }
                        $saveAbleImage = [];
                        foreach ($images as $image) {
                            PageImage::create([
                                'src' => $image,
                                'page_id' => $model->id
                            ]);
                        }
                    }

                }
                return redirect()->back()->with(config('seo.flash_message'), $totalPage . ' saved successfully');
            }
        } else {
            return redirect()->back()->with(config('seo.flash_error'), 'Invalid file');
        }
    }

    /**
     * Download page as csv
     *
     * @param Download $download
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Download $download)
    {
        $headline = ['id', 'path', 'canonical_url', 'title', 'description', 'robot_index', 'robot_follow'];
        $pages = Page::all($headline)->toArray();
        $fileManager = new FileCsv();
        $filePath = storage_path('app/public/pages/' . uniqid(date('Ymd_')) . '.csv');

        array_unshift($pages, $headline);

        $fileManager->config([
            'file_path' => $filePath,
            'data' => $pages
        ])->write();

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with(config('seo.flash_error'), 'Unable to download');
    }

    /**
     * @param Image $image
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function images(Image $image, Page $page)
    {
        $data = [
            'record' => $page
        ];
        return view('seo::pages.pages.images', $data);
    }
}
