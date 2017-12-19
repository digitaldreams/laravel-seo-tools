<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SEO\Http\Requests\Pages\Create;
use SEO\Http\Requests\Pages\Destroy;
use SEO\Http\Requests\Pages\Edit;
use SEO\Http\Requests\Pages\Index;
use SEO\Http\Requests\Pages\Show;
use SEO\Http\Requests\Pages\Store;
use SEO\Http\Requests\Pages\Update;
use SEO\Models\Page;

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
        return view('seo::pages.pages.index', ['records' => Page::paginate(10)]);
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
}
