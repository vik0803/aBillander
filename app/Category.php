<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
    
    protected $fillable = [ 'name', 'position', 'publish_to_web', 'webshop_id', 
                            'is_root', 'active', 'parent_id'
                          ];

    public static $rules = array(
    	'name'      => array('required', 'min:2',  'max:128'),
    	);
    

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    
    public function products()
    {
        return $this->hasMany('App\Product');
    }
	
}