<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 12/22/2017
 * Time: 10:30 PM
 */

namespace SEO;


use Illuminate\Http\Request;
use SEO\Models\Page;

class Tag
{
    /**
     * @var Page
     */
    public $page;

    /**
     * @var Request
     */
    protected $request;

    protected $tags=[];

    public function __construct()
    {
        $this->request = app('request');
        $this->page = Page::where('path', $this->request->path())->first();
    }

    public function scripts()
    {

    }


    public function meta()
    {


    }

    protected function robots()
    {

    }

    public function og()
    {

    }

    public function twitter()
    {

    }

    public function asHtml()
    {

    }
}