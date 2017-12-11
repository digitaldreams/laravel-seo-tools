<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SEO\Models\MetaTag;

/**
 * Description of MetaTagController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class MetaTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('metatag.index', ['records' => MetaTag::paginate(10)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('metatag.create', [
            'model' => new MetaTag,

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
        $model = new MetaTag;
        $model->fill($request->all());

        if ($model->save()) {

            session()->flash('app_message', 'MetaTag saved successfully');
            return redirect()->route('seo_meta_tags.index');
        } else {
            session()->flash('app_message', 'Something is wrong while saving MetaTag');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @param  MetaTag $metatag
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MetaTag $metatag)
    {

        return view('metatag.edit', [
            'model' => $metatag,

        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Request $request
     * @param  MetaTag $metatag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetaTag $metatag)
    {
        $metatag->fill($request->all());

        if ($metatag->save()) {

            session()->flash('app_message', 'MetaTag successfully updated');
            return redirect()->route('seo_meta_tags.index');
        } else {
            session()->flash('app_error', 'Something is wrong while updating MetaTag');
        }
        return redirect()->back();
    }

    /**
     * Delete a  resource from  storage.
     *
     * @param  Request $request
     * @param  MetaTag $metatag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, MetaTag $metatag)
    {
        if ($metatag->delete()) {
            session()->flash('app_message', 'MetaTag successfully deleted');
        } else {
            session()->flash('app_error', 'Error occurred while deleting MetaTag');
        }

        return redirect()->back();
    }
}
