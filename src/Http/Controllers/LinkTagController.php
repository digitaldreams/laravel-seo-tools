<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use SEO\Http\Requests\LinkTags\Create;
use SEO\Http\Requests\LinkTags\Destroy;
use SEO\Http\Requests\LinkTags\Edit;
use SEO\Http\Requests\LinkTags\Index;
use SEO\Http\Requests\LinkTags\Show;
use SEO\Http\Requests\LinkTags\Store;
use SEO\Http\Requests\LinkTags\Update;
use SEO\Models\LinkTag;

/**
 * Description of LinkTagController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class LinkTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Index $request)
    {
        return view('linktag.index', ['records' => LinkTag::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Create $request)
    {
        return view('linktag.create', [
            'model' => new LinkTag,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $model = new LinkTag;
        $model->fill($request->all());

        if ($model->save()) {

            session()->flash('app_message', 'LinkTag saved successfully');

            return redirect()->route('seo_link_tags.index');
        } else {
            session()->flash('app_message', 'Something is wrong while saving LinkTag');
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Edit $request, LinkTag $linktag)
    {

        return view('linktag.edit', [
            'model' => $linktag,
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, LinkTag $linktag)
    {
        $linktag->fill($request->all());

        if ($linktag->save()) {
            session()->flash('app_message', 'LinkTag successfully updated');
            return redirect()->route('seo_link_tags.index');
        } else {
            session()->flash('app_error', 'Something is wrong while updating LinkTag');
        }
        return redirect()->back();
    }

    /**
     * Delete a  resource from  storage.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Destroy $request, LinkTag $linktag)
    {
        if ($linktag->delete()) {
            session()->flash('app_message', 'LinkTag successfully deleted');
        } else {
            session()->flash('app_error', 'Error occurred while deleting LinkTag');
        }

        return redirect()->back();
    }
}
