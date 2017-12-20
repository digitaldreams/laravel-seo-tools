<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SEO\Contracts\LinkProvider;
use SEO\Http\Requests\Pages\Create;
use SEO\Http\Requests\Pages\Destroy;
use SEO\Http\Requests\Pages\Edit;
use SEO\Http\Requests\Pages\Index;
use SEO\Http\Requests\Pages\Show;
use SEO\Http\Requests\Pages\Store;
use SEO\Http\Requests\Pages\Update;
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
            session()->flash('app_message', 'Page saved successfully');
            return redirect()->route('seo::pages.index');
        } else {
            session()->flash('app_message', 'Something is wrong while saving Page');
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
            session()->flash('app_message', 'Page successfully updated');
            return redirect()->route('seo::pages.index');
        } else {
            session()->flash('app_error', 'Something is wrong while updating Page');
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
            session()->flash('app_message', 'Page successfully deleted');
        } else {
            session()->flash('app_error', 'Error occurred while deleting Page');
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

        foreach ($linkProviders as $linkProvider) {

            $obj = new $linkProvider;
            if ($obj instanceof LinkProvider) {
                $links = $obj->all();

                foreach ($links as $link) {
                    $path = parse_url($link['link'], PHP_URL_PATH);
                    $page = Page::firstOrCreate(['path' => $path]);

                    $page->canonical_url = $path;
                    $page->title_source = isset($link['title']) ? $link['title'] : '';
                    $page->description_source = isset($link['description']) ? $link['description'] : '';
                    $page->title_source = isset($link['title']) ? $link['title'] : '';
                    $page->created_at = isset($link['created_at']) ? $link['created_at'] : '';
                    $page->updated_at = isset($link['updated_at']) ? $link['updated_at'] : '';

                    if ($page->save()) {
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
        return redirect()->route('seo::pages.index')->with('app_message', 'Pages generated successfully');
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
        return redirect()->back()->with('app_message', 'Page meta tags saved successfully');
    }
}
