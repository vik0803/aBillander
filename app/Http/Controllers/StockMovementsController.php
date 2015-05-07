<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\StockMovement as StockMovement;
use View, DB;

class StockMovementsController extends Controller {


   protected $stockmovement;

   public function __construct(StockMovement $stockmovement)
   {
        $this->stockmovement = $stockmovement;
   }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $mvts = StockMovement::with('warehouse')->with('product')->with('combination')->orderBy('created_at', 'ASC')->get();
        return View::make('stock_movements.index')->with('stockmovements', $mvts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// $whList = \App\Warehouse::with('address')->lists('warehouses.addresses.alias', 'id');

		return View::make('stock_movements.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, StockMovement::$rules);

		// Has Combination?
		if ($request->has('group')) {
			$groups = $request->input('group');

			$q = '';
			foreach ($groups as $option) {
				$q .= ' (co.option_id = '.$option.') or';
			}
			$q = substr($q, 0, -2);

			$q = 'SELECT combination_id, COUNT(combination_id) tot FROM `combinations` as c
					left join combination_option as co
					on co.combination_id = c.id
					WHERE c.product_id = '.$request->input('product_id').'
					AND ( '.$q.' )
					GROUP BY combination_id ORDER BY tot DESC
					LIMIT 1';

			$result = DB::select(DB::raw($q)); // echo $q.'<br>';echo_r($result); die();

			$combination_id = $result[0]->combination_id;
		} else {
			$combination_id = 0;
		}
 
		$extradata = ['date' =>  \Carbon\Carbon::createFromFormat( \App\Context::getContext()->language->date_format_lite, $request->input('date') ), 
					  'model_name' => '', 'document_id' => 0, 'document_line_id' => 0, 'combination_id' => $combination_id, 'user_id' => \Auth::id()];

		$stockmovement = $this->stockmovement->create( array_merge( $request->all(), $extradata ) );

		// Stock movement fulfillment (perform stock movements)
		$stockmovement->fulfill();

		return redirect('stockmovements')
				->with('info', l('This record has been successfully created &#58&#58 (:id) ', ['id' => $stockmovement->id], 'layouts') . 
					$request->get('document_reference') . ' - ' . $request->input('date') );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$stockmove = $this->stockmovement->findOrFail($id);

		return View::make('stock_movements.show', compact('stockmove'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$stockmove = $this->stockmovement->find($id);

		if (is_null($stockmove))
		{
			return Redirect::route('stockmovements.index');
		}

		return View::make('stock_movements.edit', compact('stockmove'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, StockMovement::$rules);

		if ($validation->passes())
		{
			$stockmove = $this->stockmovement->find($id);
			$stockmove->update($input);

			return Redirect::route('stockmovements.show', $id);
		}

		return Redirect::route('stockmovements.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Not delete record, just reverse movement (like in accounting)  ???
		// $this->stockmovement->find($id)->delete();

		return redirect('stockmovements')
				->with('info', 'El registro se ha eliminado correctamente');
	}

}