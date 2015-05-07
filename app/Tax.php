<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 'name', 'percent', 'extra_percent', 'active' ];

    public static $rules = array(
    	'name'    => array('required', 'min:2', 'max:64'),
    	'percent' => array('required', 'numeric', 'between:0,100')
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