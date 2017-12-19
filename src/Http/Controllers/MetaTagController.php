<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SEO\Http\Requests\MetaTags\Create;
use SEO\Http\Requests\MetaTags\Destroy;
use SEO\Http\Requests\MetaTags\Edit;
use SEO\Http\Requests\MetaTags\Index;
use SEO\Http\Requests\MetaTags\Show;
use SEO\Http\Requests\MetaTags\Store;
use SEO\Http\Requests\MetaTags\Update;
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
     * @param  Index $request
     * @return Response
     */
    public function index(Index $request)
    {
        return view('seo::pages.meta_tags.index', ['records' => MetaTag::paginate(10)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param  Create $request
     * @return Response
     */
    public function create(Create $request)
    {
        return view('seo::pages.meta_tags.create', [
            'model' => new MetaTag,
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
        $model = new MetaTag;
        $model->fill($request->all());

        if ($model->save()) {

            session()->flash('app_message', 'MetaTag saved successfully');
            return redirect()->route('seo::meta-tags.index');
        } else {
            session()->flash('app_message', 'Something is wrong while saving MetaTag');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edit $request
     * @param  MetaTag $meta_tag
     * @return Response
     */
    public function edit(Edit $request, MetaTag $meta_tag)
    {
        return view('seo::pages.meta_tags.edit', [
            'model' => $meta_tag,
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Update $request
     * @param  MetaTag $meta_tag
     * @return Response
     */
    public function update(Update $request, MetaTag $meta_tag)
    {
        $meta_tag->fill($request->all());

        if ($meta_tag->save()) {

            session()->flash('app_message', 'MetaTag successfully updated');
            return redirect()->route('seo::meta-tags.index');
        } else {
            session()->flash('app_error', 'Something is wrong while updating MetaTag');
        }
        return redirect()->back();
    }

    /**
     * Delete a  resource from  storage.
     *
     * @param  Destroy $request
     * @param  MetaTag $meta_tag
     * @return Response
     * @throws \Exception
     */
    public function destroy(Destroy $request, MetaTag $meta_tag)
    {
        if ($meta_tag->delete()) {
            session()->flash('app_message', 'MetaTag successfully deleted');
        } else {
            session()->flash('app_error', 'Error occurred while deleting MetaTag');
        }

        return redirect()->back();
    }
}
