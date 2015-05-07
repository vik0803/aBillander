<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Product as Product;
use View, Form;

class ProductsController extends Controller {


   protected $product;

   public function __construct(Product $product)
   {
        $this->product = $product;
   }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $products = $this->product->with('category')->with('tax')->get();

        return View::make('products.index', compact('products'));
        
    }
    public function indexFiltered()
    {
        // return Input::get('filter_query');

		$products = $this->product
						 ->where('name', 'like', '%'.Input::get('filter_query').'%')
						 ->orWhere('reference', 'like', '%'.Input::get('filter_query').'%')
						 ->orderBy('name', 'asc')
						 ->paginate(2);
//						 ->get();
		
		$taxList = Tax::lists('name', 'id');		// http://four.laravel.com/docs/queries#selects    
													// $catlist = Category::where('type', $content_type)->lists('name');

        return View::make('products.listing', compact('products', 'taxList'));
		
		
		
		/*
        // 
		$input = Input::all();
		
		// 
		$filter_query = implode(' - ', $input);
		
		// $filter_query = Input::get('filter_query');
		
		// $filter_query = 
		
		// return Response::json(Input::get('filter_query'));
		
		// return 'abadaba';
		
		return $filter_query.' xTETAx';
		$products = $this->product->all();
        // $products = $this->product->orderBy('percent', 'desc')->get();
		
		$taxList = Tax::lists('name', 'id');		// http://four.laravel.com/docs/queries#selects    
													// $catlist = Category::where('type', $content_type)->lists('name');

        // $taxName = Tax::query()->where_id(1)->get(array('username'));
		
		return View::make('products.index', compact('products', 'taxList'));
		*/
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // if ( !( $request->input('cost_average') > 0 ) ) $request->merge( ['cost_average' => $request->input('cost_price')] );

        $action = $request->input('nextAction', '');

        $this->validate($request, Product::$rules['create']);

        // Create Product
        $product = $this->product->create($request->except('quantity_onhand'));

        // Create stock movement (Initial Stock)
        $data = [   'date' =>  \Carbon\Carbon::now(), 
                    'document_reference' => '', 
                    'price' => $request->input('price'), 
                    'quantity' => $request->input('quantity_onhand'),  
                    'notes' => '',
                    'product_id' => $product->id, 
                    'warehouse_id' => $request->input('warehouse_id'), 
                    'movement_type_id' => 10,
                    'model_name' => '', 'document_id' => 0, 'document_line_id' => 0, 'combination_id' => 0, 'user_id' => \Auth::id()
        ];

        $stockmovement = \App\StockMovement::create( $data );

        // Stock movement fulfillment (perform stock movements)
        $stockmovement->fulfill();

        if ($action == 'completeProductData')
        return redirect('products/'.$product->id.'/edit')
                ->with('info', l('This record has been successfully created &#58&#58 (:id) ', ['id' => $product->id], 'layouts') . $request->input('name'));
        else
        return redirect('products')
                ->with('info', l('This record has been successfully created &#58&#58 (:id) ', ['id' => $product->id], 'layouts') . $request->input('name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->product
                        ->with('tax')
                        ->with('warehouses')
                        ->with('combinations')
                        ->with('combinations.options')
                        ->with('combinations.options.optiongroup')
                        ->findOrFail($id);

        // Gather Attributte Groups
        $groups = array();

        if ( $product->combinations->count() )
        {
            foreach ($product->combinations as $combination) {
                foreach ($combination->options as $option) {
                    $groups[$option->optiongroup->id]['name'] = $option->optiongroup->name;
                    $groups[$option->optiongroup->id]['values'][$option->optiongroup->id.'_'.$option->id] = $option->name;
                }
            }
        } else {
            $groups = \App\OptionGroup::orderby('position', 'asc')->lists('name', 'id');
        }

        return view('products.edit', compact('product', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        if ( isset(Product::$rules['main_data']['reference']) ) Product::$rules['main_data']['reference'] .= $product->id;

        $this->validate($request, Product::$rules[ $request->input('tab_name') ]);

        $product->update($request->all());

        return redirect('products')
                ->with('success', l('This record has been successfully updated &#58&#58 (:id) ', ['id' => $id], 'layouts') . $request->input('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->product->findOrFail($id)->delete();

        return redirect('products')
                ->with('success', l('This record has been successfully deleted &#58&#58 (:id) ', ['id' => $id], 'layouts'));
    }

    /**
     * Make Combinations for specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function combine($id, Request $request)
    {
        $groups = $request->input('groups');

        // Validate: $groups ahold not be empty, and values should match options table
        // http://laravel.io/forum/11-12-2014-how-to-validate-array-input
        // https://www.google.es/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8&client=ubuntu#q=laravel%20validate%20array%20input

        $product = $this->product->findOrFail($id);

        // Start Combinator machime!

        $data = array();

        foreach ( $groups as $group ) 
        {
            $data[] = \App\Option::where('option_group_id', '=', $group)->orderby('position', 'asc')->lists('id');
        }

        $combos = combos($data);

        foreach ( $combos as $combo ) 
        {
            $combination = \App\Combination::create(array());
            $product->combinations()->save($combination);

            $combination->options()->attach($combo);;
        }

        // ToDo: Combinations are created with stock = 0. So, set main product stock = 0 too!
        // El stock del producto principal es la suma de los stocks de las combinaciones!


        return redirect('products')
                ->with('success', l('This record has been successfully combined &#58&#58 (:id) ', ['id' => $id], 'layouts'));
    }

    /**
     * Return a json list of records matching the provided query
     *
     * @return json
     */
    public function ajaxProductSearch(Request $request)
    {
        // return Product::searchByNameAutocomplete(Input::get('query'));


        $products = Product::select('id', 'name as label', 'reference')->orderBy('products.name')->where('name', 'like', '%' . $request->input('term') . '%')->get();
        
        return json_encode( $products );
    }

    /**
     * Return a json list of records matching the provided query
     *
     * @return json
     */
    public function ajaxProductOptionsSearch(Request $request)
    {
        $product = $this->product
                        ->with('tax')
                        ->with('combinations')
                        ->with('combinations.options')
                        ->with('combinations.options.optiongroup')
                        ->findOrFail($request->input('product_id'));

        // Gather Attributte Groups
        $groups = array();

        if ( $product->combinations->count() )
        {
            foreach ($product->combinations as $combination) {
                foreach ($combination->options as $option) {
                    $groups[$option->optiongroup->id]['name'] = $option->optiongroup->name;
                    // $groups[$option->optiongroup->id]['values'][$option->optiongroup->id.'_'.$option->id] = $option->name;
                    $groups[$option->optiongroup->id]['values'][$option->id] = $option->name;
                }
            }
        }

        $str = '';

        foreach ($groups as $i => $group) {
        
            $str .= Form::label('group['.$i.']', $group['name']) . Form::select('group['.$i.']', array('0' => '-- Seleccione --') + $group['values'], null, array('class' => 'form-control')) ;
        
        }
        return $str;

        // sleep(5);
        return '<select class="form-control" id="warehouse_id" name="warehouse_id"><option value="0">-- Seleccione --</option><option value="1">Main Address</option><option value="8">CALIMA 25</option></select><select class="form-control" id="warehouse_id" name="warehouse_id"><option value="0">-- Seleccione --</option><option value="1">Main Address</option><option value="8">CALIMA 25</option></select><select class="form-control" id="warehouse_id" name="warehouse_id"><option value="0">-- Seleccione --</option><option value="1">Main Address</option><option value="8">CALIMA 25</option></select>';
        return 'Hello World! '.$request->input('product_id');

        /*

SELECT combination_id, COUNT(combination_id) tot FROM `combinations` as c
left join combination_option as co
on co.combination_id = c.id
WHERE c.product_id = 15
AND (co.option_id = 4) or (co.option_id = 10) or 1
GROUP BY combination_id ORDER BY tot DESC
LIMIT 1

SELECT page, COUNT(page ) totpages
FROM visitas
GROUP BY page ORDER BY totpages DESC
LIMIT 1

        */
    }

    /**
     * Return a json list of records matching the provided query
     *
     * @return json
     */
    public function ajaxProductPriceSearch()
    {
        $product_id = Input::get('product_id');
        $customer_id = Input::get('customer_id');
        $product_string = Input::get('product_string');

        $product = Product::find(intval($product_id));
        $tax = Tax::find(intval($product->tax_id));

        // ToDo: Calculate priece per $customer_id now!
        $product->price_customer = 0.83*$product->price;
        $product->price_customer_with_tax = $product->price_customer*(1+$tax->percent/100);

        // return Product::searchByNameAutocomplete(Input::get('query'));
        return View::make('products.ajax.show_price', compact('product', 'tax', 'product_string'));
    }

}

/*    http://stackoverflow.com/questions/16661292/add-new-methods-to-a-resource-controller-in-laravel-4

Verb | Path | Action | Route Name 
 ———-|———————–|————–|——————— 
GET  | /resource           | index | resource.index 
GET  | /resource/create    | create | resource.create 
POST | /resource           | store | resource.store 
GET  | /resource/{id}      | show | resource.show 
GET  | /resource/{id}/edit | edit | resource.edit 
PUT/PATCH | /resource/{id} | update | resource.update 
DELETE | /resource/{id}    | destroy | resource.destroy

*/