<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SEO\Http\Requests\Images\Create;
use SEO\Http\Requests\Images\Destroy;
use SEO\Http\Requests\Images\Edit;
use SEO\Http\Requests\Images\Index;
use SEO\Http\Requests\Images\Show;
use SEO\Http\Requests\Images\Store;
use SEO\Http\Requests\Images\Update;
use SEO\Models\Page;
use SEO\Models\PageImage;


/**
 * Description of PageController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Index $request
     * @param Page $page
     * @return Response
     */
    public function index(Index $request, Page $page)
    {

        return view('seo::pages.images.index', [
            'records' => $page->pageImages()->paginate(10),
            'page' => $page
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param  Create $request
     * @param Page $page
     * @return Response
     */
    public function create(Create $request, Page $page)
    {
        return view('seo::pages.images.create', [
            'model' => new PageImage(),
            'page' => $page

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store $request
     * @param Page $page
     * @return Response
     */
    public function store(Store $request, Page $page)
    {
        $model = new PageImage();
        $model->fill($request->all());
        $model->page_id = $page->id;

        if ($model->save()) {
            session()->flash(config('seo.flash_message'), 'Image saved successfully');
            return redirect()->route('seo::pages.images.index', $page->id);
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while saving Image');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edit $request
     * @param  Page $page
     * @param PageImage $pageImage
     * @return Response
     */
    public function edit(Edit $request, Page $page, PageImage $pageImage)
    {
        return view('seo::pages.images.edit', [
            'model' => $pageImage,
            'page' => $page
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param Update $request
     * @param  Page $page
     * @param PageImage $pageImage
     * @return Response
     */
    public function update(Update $request, Page $page, PageImage $pageImage)
    {
        $pageImage->fill($request->all());

        if ($pageImage->save()) {
            session()->flash(config('seo.flash_message'), 'Image successfully updated');
            return redirect()->route('seo::pages.images.index', $page->id);
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while updating Image');
        }
        return redirect()->back();
    }

    /**
     * Delete a  resource from  storage.
     *
     * @param Destroy $request
     * @param  Page $page
     * @param PageImage $pageImage
     * @return Response
     * @throws \Exception
     */
    public function destroy(Destroy $request, Page $page, PageImage $pageImage)
    {
        if ($pageImage->delete()) {
            session()->flash(config('seo.flash_message'), 'Image successfully deleted');
        } else {
            session()->flash(config('seo.flash_error'), 'Error occurred while deleting Image');
        }

        return redirect()->back();
    }

}
