<?php

namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $key key
 * @property varchar $value value
 * @property varchar $status status
 * @property varchar $group group
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 */
class Setting extends Model
{

    /**
     * Database table name
     */
    protected $table = 'seo_settings';
    /**
     * Protected columns from mass assignment
     */
    protected $guarded = ['id'];

    /**
     * @param $key
     * @param string $column
     * @return bool
     */
    public function getValueByKey($key, $column = 'value')
    {
        $settings = static::where('key', $key)->first();
        return is_object($settings) ? $settings->$column : false;
    }

    /**
     * @param $files
     * @return array
     */
    public static function upload($files)
    {
        $imageMeta = [];

        $imageDriver = config('seo.storage.driver', 'public');
        $imagePrefix = config('seo.storage.prefix', 'storage');
        $imageFolder = config('seo.storage.folder', 'seo');

        foreach ($files as $key => $fields) {
            if (!isset($fields['value'])) {
                continue;
            }
            $img = $fields['value'];
            $path = $img->store($imageFolder, $imageDriver);
            $imageMeta[$key]['value'] = asset($imagePrefix . '/' . $path);
        }
        return $imageMeta;
    }
}