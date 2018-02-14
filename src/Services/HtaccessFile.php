<?php
/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 2/14/2018
 * Time: 7:37 PM
 */

namespace SEO\Services;


class HtaccessFile extends RobotTxt
{
    public function __construct()
    {
        $this->path = config('seo.htaccess', public_path('.htaccess'));
    }

}