<?php

namespace SEO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seo_settings')->insert([
            [
                'label' => 'Site Title',
                'description' => 'Site title must be below 70-80 words',
                'key' => 'site_title',
                'value' => '',
                'status' => 'active',
                'group' => 'site'
            ],
            [
                'label' => 'Title Separator',
                'description' => 'Choose the symbol to use as your title separator.
                 This will display, for instance, between your post title and site name. 
                 Symbols are shown in the size they\'ll appear in the search results',
                'key' => 'title_separator',
                'value' => '',
                'status' => 'active',
                'group' => 'site'
            ],
            [
                'label' => 'Site Description',
                'description' => 'Site Description must be below 150 words',
                'key' => 'site_description',
                'value' => '',
                'status' => 'active',
                'group' => 'site'
            ],
            [
                'label' => 'Robot Index',
                'description' => 'Change global settings for Robot index. 
                If value presents then it will overwrite all of the page robot_index.',
                'key' => 'robot_index',
                'value' => '',
                'status' => 'active',
                'group' => 'site'
            ],
            [
                'label' => 'Robot Follow',
                'description' => 'Change global settings for Robot Follow. 
                If value presents then it will overwrite all of the page robot_follow.',
                'key' => 'robot_follow',
                'value' => '',
                'status' => 'active',
                'group' => 'site'
            ],
            [
                'label' => 'Bing Webmaster Tools',
                'description' => 'Bing Webmaster Tools',
                'key' => 'bing_webmaster_tools',
                'value' => '',
                'status' => 'active',
                'group' => 'webmaster_tools'
            ],
            [
                'label' => 'Google Webmaster Tools',
                'description' => 'Google Webmaster Tools',
                'key' => 'google_webmaster_tools',
                'value' => '',
                'status' => 'active',
                'group' => 'webmaster_tools'
            ],
            [
                'label' => 'Yandex Webmaster Tools',
                'description' => 'Yandex Webmaster Tools',
                'key' => 'yandex_webmaster_tools',
                'value' => '',
                'status' => 'active',
                'group' => 'webmaster_tools'
            ],
            [
                'label' => 'Facebook Page URL',
                'description' => '',
                'key' => 'facebook_page_url',
                'value' => '',
                'status' => 'active',
                'group' => 'social_media_links'
            ],
            [
                'label' => 'Twitter Username',
                'description' => '',
                'key' => 'twitter_username',
                'value' => '',
                'status' => 'active',
                'group' => 'social_media_links'
            ],
            [
                'label' => 'Instagram URL',
                'description' => '',
                'key' => 'instagram_url',
                'value' => '',
                'status' => 'inactive',
                'group' => 'social_media_links'
            ],
            [
                'label' => 'LinkedIn URL',
                'description' => '',
                'key' => 'linkedin_url',
                'value' => '',
                'status' => 'inactive',
                'group' => 'social_media_links'
            ],
            [
                'label' => 'YouTube URL',
                'description' => '',
                'key' => 'youtube_url',
                'value' => '',
                'status' => 'inactive',
                'group' => 'social_media_links'
            ],
            [
                'label' => 'Google+ URL',
                'description' => '',
                'key' => 'google_plus_url',
                'value' => '',
                'status' => 'inactive',
                'group' => 'site'
            ],

        ]);
    }
}
