<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 2/28/2018
 * Time: 12:07 PM
 */

namespace SEO\Http\Controllers;


use Illuminate\Http\Request;
use SEO\Services\KeywordAnalysis;

class AnalysisController
{
    public function index(Request $request)
    {
        $url = $request->get('url');
        $keyword = $request->get('keyword');

        $data = [
            'success' => false
        ];
        if(!empty($url)){
            $pageAnalysis = new KeywordAnalysis($url, $keyword, true);
            if ($pageAnalysis->isSuccess()) {
                $data = array_merge($pageAnalysis->toArray(), $data);
                $data['success'] = true;
            }
        }


        return view('seo::pages.analysis.index', $data);
    }

}