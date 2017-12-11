<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('page.index', ['records' => Page::paginate(10)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Page $page)
    {
        return view('page.show', [
            'record' => $page,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('page.create', [
            'model' => new Page,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Page;
        $model->fill($request->all());

        if ($model->save()) {
            session()->flash('app_message', 'Page saved successfully');
            return redirect()->route('seo_pages.index');
        } else {
            session()->flash('app_message', 'Something is wrong while saving Page');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Page $page)
    {
        return view('page.edit', [
            'model' => $page,
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Request $request
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $page->fill($request->all());

        if ($page->save()) {
            session()->flash('app_message', 'Page successfully updated');
            return redirect()->route('seo_pages.index');
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
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Page $page)
    {
        if ($page->delete()) {
            session()->flash('app_message', 'Page successfully deleted');
        } else {
            session()->flash('app_error', 'Error occurred while deleting Page');
        }

        return redirect()->back();
    }
}
