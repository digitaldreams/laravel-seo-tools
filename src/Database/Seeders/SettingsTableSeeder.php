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
                'label' => 'How frequently the page is likely to change',
                'description' => 'Please note that the value of this tag is considered a hint and not a command',
                'key' => 'page_changefreq',
                'value' => 'monthly',
                'status' => 'active',
                'group' => 'sitemap'
            ],
            [
                'label' => 'Priority of this URL',
                'description' => 'The priority of this URL relative to other URLs on your site',
                'key' => 'page_priority',
                'value' => 0.5,
                'status' => 'active',
                'group' => 'sitemap'
            ],
            [
                'label' => 'Number of entries per sitemap',
                'description' => '',
                'key' => 'entries_per_sitemap',
                'value' => 1000,
                'status' => 'active',
                'group' => 'sitemap'
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
                'label' => 'Facebook Default Image',
                'description' => 'When no image found for a page then this image will be used',
                'key' => 'facebook_default_image',
                'value' => '',
                'status' => 'active',
                'group' => 'facebook'
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
                'label' => 'Twitter Default Image',
                'description' => 'When no image found for a page then this image will be used',
                'key' => 'twitter_default_image',
                'value' => '',
                'status' => 'active',
                'group' => 'twitter'
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
            [
                'label' => 'Organization or person',
                'description' => 'Either Person or Organization',
                'key' => 'ownership_type',
                'value' => '',
                'status' => 'active',
                'group' => 'ownership'
            ],
            [
                'label' => 'Name',
                'description' => 'Either Person or Organization name',
                'key' => 'ownership_name',
                'value' => '',
                'status' => 'active',
                'group' => 'ownership'
            ],
            [
                'label' => 'Web Site',
                'description' => '',
                'key' => 'ownership_url',
                'value' => '',
                'status' => 'active',
                'group' => 'ownership'
            ],
            [
                'label' => 'Email Address',
                'description' => '',
                'key' => 'ownership_email',
                'value' => '',
                'status' => 'active',
                'group' => 'ownership'
            ],
            [
                'label' => 'Address',
                'description' => 'Physical address of Company',
                'key' => 'ownership_address',
                'value' => '',
                'status' => 'active',
                'group' => 'ownership'
            ],
            [
                'label' => 'Logo',
                'description' => '  URL of a logo that is representative of the organization.',
                'key' => 'ownership_logo',
                'value' => '',
                'status' => 'active',
                'group' => 'ownership'
            ],
            [
                'label' => 'Contact Type Telephone',
                'description' => '  URL of a logo that is representative of the organization.',
                'key' => 'ownership_contact_point_telephone',
                'value' => '',
                'status' => 'active',
                'group' => 'ownership'
            ],
            [
                'label' => 'Contact Type',
                'description' => '',
                'key' => 'ownership_contact_point_contact_type',
                'value' => 'customer service',
                'status' => 'active',
                'group' => 'ownership'
            ],
        ]);
    }
}
