<?php
/**
 * User: Tuhin
 * Date: 12/24/2017
 * Time: 7:48 AM
 */

namespace SEO\Services;


class RobotTxt
{

    /**
     * @var
     */
    protected $path;

    /**
     * RobotTxt constructor.
     */
    public function __construct()
    {
        $this->path = config('seo.robot_txt', public_path('robots.txt'));
    }

    /**
     * @return string
     */
    public function get()
    {
        $file = $this->file('r');
        if ($file->getSize() > 0)
            return trim($file->fread($file->getSize()));
        return '';
    }

    /**
     * @param string $content
     */
    public function save($content = '')
    {
        $file = $this->file();
        $file->fwrite($content);
        $file->fflush();
    }

    /**
     * @param string $mode
     * @return \SplFileObject
     */
    public function file($mode = 'w+')
    {
        return new \SplFileObject($this->path, $mode);

    }
}