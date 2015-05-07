<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combination extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 'name', 'reference', 'ean13', 'description', 
                            'quantity_onhand', 'warranty_period', 
                            'reorder_point', 'maximum_stock', 'price', 'cost_price', 'supply_lead_time', 
                            'location', 'width', 'height', 'depth', 'weight', 
                            'notes', 'stock_control', 'publish_to_web', 'blocked', 'active', 
                          ];

    public static $rules = array();
    

    public function name($separator = ' - ')
    {        
        // Gather Attributtes & Groups
        $combination = Combination::with('options')
                        ->with('options.optiongroup')
                        ->findOrFail($this->id);
        $name = [];

        foreach ($combination->relations['options'] as $att) {
            $name[] = $att->optiongroup->name . ': ' . $att->name; 
        }
        return implode($separator, $name);
    }

    
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function product()
    {
        return $this->belongsTo('App\Product');
	}
    
    public function options()
    {
        return $this->belongsToMany('App\Option')->withTimestamps();
    }
    
    public function stockmovements()
    {
        return $this->hasMany('App\StockMovement');
    }
    
    public function warehouses()
    {
        return $this->belongsToMany('App\Warehouse')->withPivot('quantity')->withTimestamps();
    }
}
