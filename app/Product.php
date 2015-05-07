<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 'name', 'reference', 'ean13', 'description', 
                            'quantity_onhand', 'warranty_period', 
                            'reorder_point', 'maximum_stock', 'price', 'cost_price', 'supply_lead_time', 
                            'location', 'width', 'height', 'depth', 'weight', 
                            'notes', 'stock_control', 'publish_to_web', 'blocked', 'active', 
                            'tax_id', 'category_id', 'main_supplier_id',
                          ];

    public static $rules = array(
        'create' => array(
                        	'name'        => 'required|min:2|max:128',
                        	'reference'   => 'required|min:2|max:32|unique:products,reference', 
                            'price'       => 'required|numeric|min:0',
                            'cost_price'      => 'required|numeric|min:0',
                            'tax_id'      => 'exists:taxes,id',
                            'category_id' => 'exists:categories,id',
                            'quantity_onhand' => 'required|numeric|min:0',
                            'warehouse_id' => 'exists:warehouses,id',
                    ),
        'main_data' => array(
                            'name'        => array('required', 'min:2', 'max:128'),
                            'reference'   => 'required|min:2|max:32|unique:products,reference,',     // https://laracasts.com/discuss/channels/requests/laravel-5-validation-request-how-to-handle-validation-on-update
                            'tax_id'      => 'exists:taxes,id',
                            'category_id' => 'exists:categories,id',
                    ),
        );
    
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

// http://stackoverflow.com/questions/12941397/laravel-eloquent-one-to-many-relationships

    public function tax()
    {
        return $this->belongsTo('App\Tax');
	}
		
    public function category()
    {
        return $this->belongsTo('App\Category');
	}
    
    public function combinations()
    {
        return $this->hasMany('App\Combination');
    }
    
    public function stockmovements()
    {
        return $this->hasMany('App\StockMovement');
    }
    
    public function warehouses()
    {
        return $this->belongsToMany('App\Warehouse')->withPivot('quantity')->withTimestamps();
    }
    

    /*
    |--------------------------------------------------------------------------
    | Data Provider
    |--------------------------------------------------------------------------
    */

    /**
     * Provides a json encoded array of matching product names
     * @param  string $query
     * @return json
     */
    public static function searchByNameAutocomplete($query, $customer_id = NULL)
    {
        $products = Product::select('*', 'products.name as product_name', 'taxes.name as tax_name')->leftjoin('taxes','taxes.id','=','products.tax_id')->orderBy('products.name')->where('products.name', 'like', '%' . $query . '%')->get();
        
        /*
        $return = array();

        foreach ($products as $product)
        {
            // $return[]['value'] = $client->name_fiscal;
            $return[] = array ('value' => $client->name_fiscal, 'data' => $client->id);
        }

        return json_encode( array('query' => $query, 'suggestions' => $return) );
        */

        // return json_encode( $products );
        return json_encode( array('query' => $query, 'suggestions' => $products) );
    }
	
}