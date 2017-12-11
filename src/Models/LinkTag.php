<?php
namespace SEO\Models;

use Illuminate\Database\Eloquent\Model;

/**
   @property varchar $rel rel
@property varchar $href href
@property varchar $status status
@property int $page_id page id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
   
 */
class LinkTag extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'seo_link_tags';
    /**
    * Protected columns from mass assignment
    */
    protected $guarded=['id'];


    /**
    * Date time columns.
    */
    protected $dates=[];




}