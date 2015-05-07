<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['alias', 'notes'];

    // Add your validation rules here
    public static $rules = array(
        'alias' => array('required', 'min:2', 'max:32'),
        'address_id'  => 'exists:addresses,id',
    	);


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function address()
    {
        return $this->hasOne('App\Address', 'owner_id')->where('model_name', '=', 'Warehouse');
    }

    // See: http://www.developed.be/2013/08/30/laravel-4-pivot-table-example-attach-and-detach/
    // See also: http://johnveldboom.com/posts/5/working-with-data-in-pivot-tables-using-laravel-4-eloquent-orm
    // http://hitmyserver.net/laravel-4-pivot-table-data.html
    // http://stackoverflow.com/questions/15833335/how-to-make-my-own-timestamp-method-in-laravel
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity')->withTimestamps();
    }

    public function combinations()
    {
        return $this->belongsToMany('App\Combination')->withPivot('quantity')->withTimestamps();
    }
	
    /*
    public function currency()
    {
        return $this->hasOne('Currency');
    }
    */  
    
    public function stockmovements()
    {
        return $this->hasMany('App\StockMovement');
    }
    
}