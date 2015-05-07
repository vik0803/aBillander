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
        'alias'      => 'required|min:2|max:32',
        'address1'   => 'required|min:2|max:128',
        );

    public static function related_rules($rel = 'address')
    {
        // https://laracasts.com/discuss/channels/requests/laravel-5-validation-request-how-to-handle-validation-on-update/?page=1
        $rules = array();
        
        foreach ( self::$rules as $key => $rule) 
        {
            $rules[ $rel.'.'.$key ] = $rule;
        }
        return $rules;
    }


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
    
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse', 'owner_id')->where('model_name', '=', 'Warehouse');
    }
    
}