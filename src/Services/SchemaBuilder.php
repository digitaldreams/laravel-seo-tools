<?php
/**
 * User: Tuhin
 * Date: 2/16/2018
 * Time: 11:34 PM
 */

namespace SEO\Services;


use Illuminate\Support\Collection;
use SEO\Models\Setting;

class SchemaBuilder
{
    /**
     * @var Collection
     */
    protected $settings = [];

    protected $socialAccounts = [];

    public function __construct()
    {
        $this->settings = Setting::where('group', 'ownership')->pluck('value', 'key')->toArray();
        $this->socialAccounts = Setting::where('group', 'social_media_links')->pluck('value', 'key')->toArray();
    }

    /**
     * @return null|string
     */
    public function ownership()
    {
        $info = $this->buildOwnerShip();
        return !empty($info) ? json_encode($info, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : null;
    }

    /**
     * @return array|void
     */
    private function buildOwnerShip()
    {
        $arr = [];

        if (!empty($this->settings['ownership_type'])) {
            $arr['@context'] = 'http://schema.org';
            $arr['@type'] = $this->settings['ownership_type'];
            $arr['name'] = $this->settings['ownership_name'];
            $arr['url'] = $this->settings['ownership_url'];
            $arr = $this->logo($arr);

            if (!empty($this->settings['ownership_address'])) {
                $arr['address'] = $this->settings['ownership_address'];
            }
            if (!empty($this->settings['ownership_email']) && filter_var($this->settings['ownership_email'], FILTER_VALIDATE_EMAIL)) {
                $arr['email'] = $this->settings['ownership_email'];
            }

            $arr['sameAs'] = $this->getSocialMediaLinks();
            $arr = $this->telephone($arr);


        }
        return $arr;
    }

    /**
     *
     */
    private function getSocialMediaLinks()
    {
        $retArr = [];

        foreach ($this->socialAccounts as $sm => $url) {
            if (!empty($url)) {
                $retArr[] = $url;
            }
        }
        return $retArr;
    }

    /**
     * @param $arr
     * @return mixed
     */
    private function telephone($arr)
    {
        if (isset($this->settings['ownership_contact_point_telephone']) && !empty($this->settings['ownership_contact_point_telephone'])) {
            if ($this->settings['ownership_type'] == 'Organization') {
                $arr['contactPoint'] = [
                    [
                        "@type" => "ContactPoint",
                        'telephone' => $this->settings['ownership_contact_point_telephone'],
                        'contactType' => $this->settings['ownership_contact_point_contact_type']
                    ]
                ];
            } else {
                $arr['telephone'] = $this->settings['ownership_contact_point_telephone'];
            }
        }
        return $arr;
    }

    /**
     * @param $arr
     * @return array
     */
    private function logo($arr)
    {
        if (isset($this->settings['ownership_logo']) && !empty($this->settings['ownership_logo']) && filter_var($this->settings['ownership_logo'], FILTER_VALIDATE_URL)) {
            if ($this->settings['ownership_type'] == 'Organization') {
                $arr['logo'] = $this->settings['ownership_logo'];
            } else {
                $arr['image'] = $this->settings['ownership_logo'];
            }
        }
        return $arr;
    }


}