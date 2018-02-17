<?php
/**
 * User: Tuhin
 * Date: 2/17/2018
 * Time: 12:50 PM
 */

namespace SEO\Services;


class Helper
{
    public static function fileSize($url)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

            return $size;
        } catch (\Exception $e) {
            return false;
        }
    }

    protected function addToCache($url)
    {

    }



}