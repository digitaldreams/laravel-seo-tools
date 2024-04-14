<?php

namespace SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SEO\Http\Requests\Settings\Edit;
use SEO\Http\Requests\Settings\Index;
use SEO\Http\Requests\Settings\Store;
use SEO\Http\Requests\Settings\Update;
use SEO\Models\MetaTag;
use SEO\Models\Setting;
use SEO\Services\HtaccessFile;
use SEO\Services\RobotTxt;
use SEO\Services\SiteMap;

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
     * @return Response
     */
    public function index(Index $request)
    {
        return view('seo::pages.settings.index', [
                'records' => Setting::paginate(10),
                'model' => new Setting(),
                'sitemaps' => (new SiteMap())->all(),
                'metaTags'=>[]
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
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
     * @return Response
     */
    public function update(Update $request, Setting $setting)
    {
        $setting->fill($request->all());

        if ($setting->save()) {
            session()->flash(config('seo.flash_message'), 'Setting successfully updated');
            return redirect()->route('seo::settings.index');
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while updating Setting');
        }
        return redirect()->back();
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Setting $setting
     * @return Response
     */
    public function store(Store $request)
    {
        $settings = $request->get('settings', []);
        foreach ($settings as $key => $fields) {
            Setting::where('key', $key)->update($fields);
        }
        $fields = $request->file('settings', []);
        $files = Setting::upload($fields);

        foreach ($files as $key => $fileFields) {
            Setting::where('key', $key)->update($fileFields);
        }
        session()->flash(config('seo.flash_message'), 'Setting successfully updated');

        return redirect()->back();
    }

    /**
     * Update robot.txt file
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function robotTxt(Request $request)
    {
        $robotValue = $request->get('robot_txt');
        $robotTxt = new RobotTxt();
        $robotTxt->save($robotValue);

        return redirect()->back()->with(config('seo.flash_message'), 'Robot.txt file updated successfully');

    }

    /**
     * Update robot.txt file
     *
     * @return void
     */
    public function htaccess(Request $request)
    {
        $htaccessValue = $request->get('htaccess');

        $htaccess = new HtaccessFile();
        $htaccess->save($htaccessValue);

        return redirect()->back()->with(config('seo.flash_message'), '.htaccess file updated successfully');
    }
}
