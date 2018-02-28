<?php
/**
 * User: Tuhin
 * Date: 2/28/2018
 * Time: 9:44 AM
 */

namespace SEO\Services;


class KeywordAnalysis extends PageAnalysis
{
    /**
     * @var
     */
    protected $keyword;

    /**
     * @var array
     */
    protected $good = [];

    /**
     * @var array
     */
    protected $warnings = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * KeywordAnalysis constructor.
     * @param $url
     * @param $keyword
     */
    public function __construct($url, $keyword, $size = false)
    {
        parent::__construct($url);
        $this->keyword = $keyword;
        $this->fetch($size);
    }

    /**
     *
     */
    public function density()
    {
        $keywordWord = str_word_count($this->keyword);
        $pageWord = str_word_count($this->textContent());

        return round(($keywordWord / $pageWord) * 100, 2);
    }

    /**
     * @return $this
     */
    public function inTitle()
    {

        $matches = $this->find($this->data['title']);
        if ($matches > 0) {
            $this->good[] = 'Keyword found in title';
        } else {
            $this->errors[] = 'Keyword is not found on title';
        }
        return $this;

    }

    /**
     * @return $this
     */
    public function run()
    {
        $this->inTitle()->inDescription()->inHeadings()->inImageAlt()->inFirstPara()->density();
        return $this;
    }

    /**
     * @return $this
     */
    public function inDescription()
    {
        if (isset($this->data['metas']['description'])) {
            $matches = $this->find($this->data['metas']['description']['content']);
            if ($matches > 0) {
                $this->good[] = 'Keyword found in meta description';
            } else {
                $this->errors[] = 'Keyword is not found on meta description';
            }
        } else {
            $this->errors[] = 'No meta description found';
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function inHeadings()
    {
        $h1 = isset($this->data['headings']['h1']) ? $this->data['headings']['h1'] : [];
        if (is_array($h1) && count($h1) > 0) {
            $matches = $this->find(array_shift($h1));
            if ($matches > 0) {
                $this->good[] = 'Keyword found on h1 tag';
            } else {
                $this->errors[] = 'Keyword not found on h1 tag';
            }
        } else {
            $this->warnings[] = 'No h1 tag found in this page';
        }
        $h2 = isset($this->data['headings']['h2']) ? $this->data['headings']['h2'] : [];
        $h2Found = 0;

        foreach ($h2 as $text) {
            $matches = $this->find($text);
            if ($matches > 0) {
                $h2Found++;
            }
        }
        if (count($h2) > 0 && $h2Found > 0) {
            $this->good[] = 'Keyword found on h2 tag';
        }

        $h3 = isset($this->data['headings']['h3']) ? $this->data['headings']['h3'] : [];
        $h3Found = 0;

        foreach ($h3 as $text) {
            $matches = $this->find($text);
            if ($matches > 0) {
                $h3Found++;
            }
        }
        if (count($h3) > 0 && $h3Found > 0) {
            $this->good[] = 'Keyword found on h3 tag';
        } else {
            $this->warnings[] = 'Keyword does not found any of h3 tag';
        }

        return $this;
    }

    /**
     *
     */
    public function inImageAlt()
    {
        $images = $this->data['images'];
        $found = 0;
        $altArr = array_column($images, 'alt');

        foreach ($altArr as $alt) {
            $matches = $this->find($alt);
            if ($matches > 0) {
                $found++;
            }
        }
        if (count($altArr) > 0 && $found > 0) {
            $this->good[] = 'Found in alt tag';
        } elseif (count($altArr) > 0) {
            $this->warnings[] = 'Its good to have foucus keyword on one of image alt tag but none found';
        }
        if (count($altArr) < count($images)) {
            $this->warnings[] = count($images) - count($altArr) . ' alt attribute missing from image';
        }
        return $this;

    }

    /**
     *
     */
    public function inFirstPara()
    {
        return $this;
    }

    /**
     * @param $string
     * @return int
     */
    public function find($string)
    {
        preg_match_all('/(' . $this->keyword . ')/i', $string, $matches, PREG_SET_ORDER);
        return count($matches);
    }

    public function result()
    {
        return [
            'good' => $this->good,
            'warnings' => $this->warnings,
            'errors' => $this->errors,

        ];
    }

}