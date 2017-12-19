<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use SEO\Http\Requests\Settings\Edit;
use SEO\Http\Requests\Settings\Index;
use SEO\Http\Requests\Settings\Store;
use SEO\Http\Requests\Settings\Update;
use SEO\Models\MetaTag;
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
        return view('seo::pages.settings.index', [
                'records' => Setting::paginate(10),
                'metaTags' => MetaTag::paginate(10),
                'model' => new Setting()
            ]
        );
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
        return view('seo::pages.settings.edit', [
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
            return redirect()->route('seo::settings.index');
        } else {
            session()->flash('app_error', 'Something is wrong while updating Setting');
        }
        return redirect()->back();
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Store $request
     * @param  Setting $setting
     * @return Response
     */
    public function store(Store $request)
    {
        $settings = $request->get('settings', []);
        foreach ($settings as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }
        session()->flash('app_message', 'Setting successfully updated');
        return redirect()->back();
    }
}
