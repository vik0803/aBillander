<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Currency as Currency;
use View;

class ConfigurationKeysController extends Controller {

   public $conf_keys = array();

   public function __construct()
   {

        $this->conf_keys = array(
                    1 => array(
                                'COMPANY_BO_LOGO' => Configuration::get('COMPANY_BO_LOGO'),
                                'MARGIN_METHOD'   => Configuration::get('MARGIN_METHOD'),
                                'ALLOW_SALES_WITHOUT_STOCK' => Configuration::get('ALLOW_SALES_WITHOUT_STOCK'),
                                'ALLOW_SALES_RISK_EXCEEDED' => Configuration::get('ALLOW_SALES_RISK_EXCEEDED'),
                        ),
                    2 => array(
                                'DEF_COUNTRY_NAME'       => Configuration::get('DEF_COUNTRY_NAME'),
                                'DEF_ITEMS_PERPAGE'      => Configuration::get('DEF_ITEMS_PERPAGE'),
                                'DEF_ITEMS_PERAJAX'      => Configuration::get('DEF_ITEMS_PERAJAX'),
                                'DEF_LANGUAGE'           => Configuration::get('DEF_LANGUAGE'),
                                'DEF_OUTSTANDING_AMOUNT' => Configuration::get('DEF_OUTSTANDING_AMOUNT'),
                                'DEF_WAREHOUSE'          => Configuration::get('DEF_WAREHOUSE'),
                        ),
        );

   }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $conf_keys = array();
        $tab_index =   Input::has('tab_index')
                        ? intval(Input::get('tab_index'))
                        : 1;
        
        // Check tab_index
        $tab_view = 'configurationkeys.'.'key_group_'.intval($tab_index);
        if (!View::exists($tab_view)) 
            return Redirect::to('404')->with('error', 'No se ha encontrado el Grupo de Claves de Configuración solicitado ('.intval($tab_index).')');

        $key_group = $this->conf_keys[$tab_index];

        return View::make( $tab_view, compact('tab_index', 'key_group') );
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        die(Input::get('tab_index'));

        $input = Input::all();
		
		// STEP 1 : validate data (pendding)
        $validator = Validator::make($input, Customer::$rules);

        if ( !$validator->passes() ) 
            return Redirect::back()->withErrors($validator)->withInput();
		
		// STEP 2 : build objects
		
		// Customer Stuff
        $customerData = array();
		$customerData['name_fiscal']     = $input['name_fiscal'];
//		$customerData['name_commercial'] = $input['name_commercial'];
//      $customerData['firstname']       = $input['firstname'];
//      $customerData['lastname']        = $input['lastname'];
//      $customerData['email']           = $input['email'];
        $customerData['website']         = Input::get('website', '');
        $customerData['identification']  = Input::get('identification', '');

//      $customerData['phone']           = $input['phone'];
//      $customerData['phone_mobile']    = $input['phone_mobile'];
//      $customerData['fax']             = $input['fax'];

        $customerData['outstanding_amount_allowed'] = Input::get('outstanding_amount_allowed', Configuration::get('DEF_OUTSTANDING_AMOUNT'));
        $customerData['outstanding_amount']         = 0;
        $customerData['unresolved_amount']          = 0;

        $customerData['notes']           = Input::get('notes', '');

        $customerData['accept_einvoice'] = Input::get('accept_einvoice', 0);
        $customerData['accept_einvoice'] = intval($customerData['accept_einvoice']) > 0 ? 1 : 0;
        $customerData['blocked']         = 0;
        $customerData['active']          = Input::get('activce', 1);
        $customerData['active']          = intval($customerData['active'])          > 0 ? 1 : 0;

        // Customer Relations!
        $customerData['salesrep_id']             = 0;
        $customerData['currency_id']             = 0;
        $customerData['customer_group_id']       = 0;
        $customerData['payment_method_id']       = 0;
        $customerData['sequence_id']             = 0;
        $customerData['carrier_id']              = 0;
        $customerData['price_list_id']           = 0;
        $customerData['direct_debit_account_id'] = 0;

        $customerData['invoicing_address_id']    = 0;
        $customerData['shipping_address_id']     = 0;

        // Addresses Stuff
		
		$addressInvData = array();
        $addressInvData['alias']           = 'Dirección Principal';
        $addressInvData['model_name']      = 'Customer';

		$addressInvData['name_commercial'] = Input::get('name_commercial', '');
        $addressInvData['address1']        = Input::get('address1', '');
        $addressInvData['address2']        = Input::get('address2', '');
        $addressInvData['postcode']        = Input::get('postcode', '');
        $addressInvData['city']            = Input::get('city', '');
        $addressInvData['state']           = Input::get('state', '');
        $addressInvData['country']         = Input::get('country', Configuration::get('DEF_COUNTRY_NAME'));

        $addressInvData['firstname']       = Input::get('firstname', '');
        $addressInvData['lastname']        = Input::get('lastname', '');
        $addressInvData['email']           = Input::get('email', '');

        $addressInvData['phone']           = Input::get('phone', '');
        $addressInvData['phone_mobile']    = Input::get('phone_mobile', '');
        $addressInvData['fax']             = Input::get('fax', '');

		$addressInvData['notes']           = '';

        $addressInvData['active']          = 1;

        $addressInvData['latitude']        = 0;
        $addressInvData['longitude']       = 0;

        // Address Relations!
        $addressInvData['owner_id']          = 0;
        $addressInvData['state_id']          = 0;
        $addressInvData['country_id']        = 0;
		
		$addressShipData = array();
//		$addressShipData[''] = $input['ship_address_'];

		$customer  = Customer::create($customerData);
		$addressInv = Address::create($addressInvData);
		
		$addressInv->Customer()->associate($customer);
		
		$customer->addresses()->save($addressInv);

        $customer->invoicing_address_id = $addressInv->id;
        $customer->shipping_address_id  = $addressInv->id;
        $customer->save();
		// $customer->touch();
		
		// See: http://stackoverflow.com/questions/16740973/one-to-many-relationship-inserts-2-records-into-table
		// Kind of different...
		
		/*
            return Redirect::route('customers.create')
				->withInput()
				->with('message_error', 'Esta txuta!');
		*/
        // return Redirect::to('customers/' . $customer->id . '/edit')
        return Redirect::to('customers')
                ->with('success', 'El Cliente se ha creado correctamente.');
        
        // return Redirect::route('customers.create')
        //        ->with('message_error', 'Esta txuta!');
/*
        $v = Validator::make($input, Customer::$rules);

        if ($v->passes())
        {
            $this->customer->create($input);

            return Redirect::route('admin.customers.index')
				->with('message_info', 'El registro se ha creado correctamente: '. $input['name'].' - '.$input['percent'].'%');
        }

        return Redirect::route('admin.customers.create')
            ->withInput()
            ->withErrors($v)
            ->with('message_error', 'There were validation errors');
*/			
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $customer = $this->customer->findOrFail($id);

        return View::make('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $customer     = $this->customer->with('addresses', 'mainAddress')->find($id); // Recuperar con dirección de facturación (mainAddress)

        if (is_null($customer))
        {
            return Redirect::route('customers.index')
                     ->with('error', 'El Cliente id='.$id.' no existe.');;
        }

        $aBook       = $customer->addresses;
        if ( !($aBookCount = count($aBook)) )
        {
            // Libro de direcciones vacío
            $aBook       = array();
            $mainAddress = 0;

            // Issue Warning!
        } else {
            // So far, so good!
            $mainAddr = $customer->invoicing_address_id;
            $mainAddressIndex = -1;

            foreach ($aBook as $key => $value) {
                if ($mainAddr == $value->id) {
                    $mainAddressIndex = $key;
                    break;
                }
            }
            if ($mainAddressIndex < 0) ; // Issue warning!
        }

        // echo '<pre>'; print_r($aBook); echo '</pre>'; die();

        return View::make('customers.edit', compact('customer', 'aBook', 'mainAddressIndex'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $section =  Input::has('tab_name')     ? 
                    '#'.Input::get('tab_name') :
                    '';
        // Redirect::to(URL::route('your.named.route') . "#yourhashtag");
        // return Redirect::route('customers.edit', $id)
        return Redirect::to(route('customers.edit', $id) . $section)
            ->with('error', 'There were validation errors.' . $section);

        $input = array_except(Input::all(), '_method');
        $v = Validator::make($input, Customer::$rules);

        if ($v->passes())
        {
            $customer = $this->customer->find($id);
            $customer->update($input);

            return Redirect::route('admin.customers.index')
				->with('message_info', 'El registro se ha actualizado correctamente: '. $input['name'].' - '.$input['percent'].'%');
        }

        return Redirect::route('admin.customers.edit', $id)
            ->withInput()
            ->withErrors($v)
            ->with('message_error', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->customer->find($id)->delete();

        return Redirect::route('admin.customers.index')
				->with('message_info', 'El registro se ha eliminado correctamente');
    }

    

    /**
     * Return a json list of records matching the provided query
     * @return json
     */
    public function ajaxCustomerSearch()
    {
        return Customer::searchByNameAutocomplete(Input::get('query'));
    }

}