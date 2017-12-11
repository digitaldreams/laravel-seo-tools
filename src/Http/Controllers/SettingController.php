<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use SEO\Http\Requests\Settings\Edit;
use SEO\Http\Requests\Settings\Index;
use SEO\Http\Requests\Settings\Update;
use SEO\Models\Setting;

/**
 * Description of SettingController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Index $request
     * @return Response
     */
    public function index(Index $request)
    {
        return view('setting.index', ['records' => Setting::paginate(10)]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edit $request
     * @param  Setting $setting
     * @return Response
     */
    public function edit(Edit $request, Setting $setting)
    {
        return view('setting.edit', [
            'model' => $setting,
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Update $request
     * @param  Setting $setting
     * @return Response
     */
    public function update(Update $request, Setting $setting)
    {
        $setting->fill($request->all());

        if ($setting->save()) {

            session()->flash('app_message', 'Setting successfully updated');
            return redirect()->route('seo_settings.index');
        } else {
            session()->flash('app_error', 'Something is wrong while updating Setting');
        }
        return redirect()->back();
    }

}
