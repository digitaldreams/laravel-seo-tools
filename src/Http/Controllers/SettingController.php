<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('setting.index', ['records' => Setting::paginate(10)]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Setting $setting)
    {
        return view('setting.edit', [
            'model' => $setting,
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Request $request
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
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
