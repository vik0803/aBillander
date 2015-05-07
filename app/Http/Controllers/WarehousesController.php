<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Warehouse as Warehouse;
use App\Address as Address;
use View;

class WarehousesController extends Controller {


   protected $warehouse;
   protected $address;

   public function __construct(Warehouse $warehouse, Address $address)
   {
        $this->warehouse = $warehouse;
        $this->address = $address;
   }

	/**
	 * Display a listing of the resource.
	 * GET /warehouses
	 *
	 * @return Response
	 */
	public function index()
	{
        $warehouses = $this->warehouse->with('address')->get();

        return view('warehouses.index', compact('warehouses'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /warehouses/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('warehouses.create'); 
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /warehouses
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// ToDo: new field warehouses.alias

		$this->validate($request, Address::$rules);

		$warehouse = $this->warehouse->create(['notes' => $request->input('notes'), 'alias' => $request->input('alias'), 'active' => 1]);
			$request->merge( ['model_name' => 'Warehouse'] );
		$address = $this->address->create($request->all());
		$warehouse->address->save($address);

		return redirect('warehouses')
				->with('info', l('This record has been successfully created &#58&#58 (:id) ', ['id' => $warehouse->id], 'layouts') . $request->get('name'));
	}

	/**
	 * Display the specified resource.
	 * GET /warehouses/{id}
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
	 * GET /warehouses/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$warehouse = $this->warehouse->with('address')->findOrFail($id);
		
		return view('warehouses.edit', compact('warehouse'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /warehouses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$warehouse = Warehouse::findOrFail($id);
		$address = $warehouse->address;

		$this->validate($request, Address::related_rules());

		// http://stackoverflow.com/questions/17950118/laravel-eloquent-how-to-update-a-model-and-related-models-in-one-go
		$warehouse->update( array_merge($request->all(), ['alias' => $request->input('address.alias')] ) );
			$request->merge($request->input('address'));
			$request->merge(['notes' => '']);  
		$address->update($request->except(['address']));

		return redirect('warehouses')
				->with('info', l('This record has been successfully updated &#58&#58 (:id) ', ['id' => $id], 'layouts') . $request->get('name_commercial'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /warehouses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->warehouse->findOrFail($id)->delete();

        return redirect('warehouses')
				->with('success', l('This record has been successfully deleted &#58&#58 (:id) ', ['id' => $id], 'layouts'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexProducts($id)
	{
        $wh = Warehouse::find($id);

        if (is_null($wh)) 
        {
        	return Redirect::route('warehouses.index');
       	}

        return View::make('warehouses.indexProducts')->with(array('warehouse' => $wh, 'products' => $wh->products));
	}
	
	public function indexStockmoves($id)
	{
        $wh = Warehouse::find($id);

        if (is_null($wh)) 
        {
        	return Redirect::route('warehouses.index');
       	}

        return View::make('warehouses.indexStockmoves')->with(array('warehouse' => $wh, 'stockmoves' => $wh->stockmoves));
	}

}