<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 12/22/2017
 * Time: 8:52 PM
 */

namespace SEO\Http\Controllers;


use Illuminate\Http\Request;

class DashboardController
{
    public function index(Request $request)
    {
        $data = [];
        return view('seo::pages.dashboard.index', $data);
    }
}