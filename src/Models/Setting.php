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
     * @return bool
     */
    public function getValueByKey($key)
    {
        $settings = static::where('key', $key)->select(['key','value'])->first();
        return is_object($settings) ? $settings->value : false;
    }

}