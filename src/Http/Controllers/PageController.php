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
use SEO\Jobs\PageCacheJob;
use SEO\Jobs\PageGeneratorJob;
use SEO\Jobs\PageUploadJob;
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
        return view('seo::pages.pages.index', ['records' => Page::withCount(['pageImages'])->paginate(5)]);
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
     * @param  Update $request
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
        dispatch(new PageGeneratorJob());
        return redirect()->route('seo::pages.index')->with(config('seo.flash_message'), ' Your request are in queue now. ');
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
                dispatch(new PageUploadJob($fullPath));
                return redirect()->back()->with(config('seo.flash_message'), 'Your file are in queue now.');
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
        $headline = ['id', 'path', 'canonical_url', 'title', 'description', 'robot_index', 'robot_follow', 'change_frequency', 'priority'];
        $pages = Page::all($headline);
        $fileManager = new FileCsv();
        $filePath = storage_path('app/public/pages/' . uniqid(date('Ymd_')) . '.csv');
        $data = [];
        foreach ($pages as $page) {
            $data[] = [
                'id' => '"' . $page->id . '"',
                'path' => '"' . $page->path . '"',
                'canonical_url' => '"' . $page->getCanonical() . '"',
                'title' => '"' . $page->getTitle() . '"',
                'description' => '"' . $page->getDescription() . '"',
                'robot_index' => '"' . $page->robot_index . '"',
                'robot_follow' => '"' . $page->robot_follow . '"',
                'change_frequency' => '"' . $page->getChangeFrequency() . '"',
                'priority' => '"' . $page->getPriority() . '"',
            ];
        }
        array_unshift($data, $headline);

        $fileManager->config([
            'file_path' => $filePath,
            'data' => $data
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

    /**
     * Cache page seo tags
     */
    public function cache()
    {
        dispatch(new PageCacheJob());
        return redirect()->back()->with(config('seo.flash_message'), 'Your request to refresh cache are in queue now.');
    }
}
