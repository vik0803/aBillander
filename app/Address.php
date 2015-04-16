<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 'alias', 'name_commercial', 
                            'address1', 'address2', 'postcode', 'city', 'state', 'country', 
                            'firstname', 'lastname', 'email', 
                            'phone', 'phone_mobile', 'fax', 'notes', 'active', 
                            'latitude', 'longitude',
                          ];

    public static $rules = array(
    	'alias'      => array('required', 'min:2', 'max:32'),
//    	'model_name' => array('required', 'min:2', 'max:64' ),
//		'owner_id'   => array('numeric', 'min:0'),

        'address1'   => array('required', 'min:2', 'max:128'),
    	);


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    

 /*
    public function company()
    {
        if ($this->model_name != 'Company') return NULL;

        return $this->belongsTo('App\Company', 'owner_id')->where('model_name', '=', 'Company');
    }
*/

    public function customer()
    {
        if ($this->model_name != 'App\Customer') return NULL;

        return $this->belongsTo('App\Customer', 'owner_id')->where('model_name', '=', 'Customer');
    }
	
}