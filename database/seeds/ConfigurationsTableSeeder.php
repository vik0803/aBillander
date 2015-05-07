<?php

use Illuminate\Database\Seeder;

// use Illuminate\Support\Facades\DB;
// use App\Models\Contact;

class ConfigurationsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('configurations')->truncate();
		DB::table('configurations')->delete();
		
		$configurations = array(
			array(	'name'        => 'SW_VERSION', 
					'value'       => '0.00.12',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),		// date('Y-m-d H:i:s');
					),
			array(	'name'        => 'COMPANY_BO_LOGO', 
					'value'       => '<span style="color:#bbb"><i class="fa fa-bolt"></i> Lar<span style="color:#fff">aBillander</span></span>',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),		// date('Y-m-d H:i:s');
					),
			array(	'name'        => 'TIMEZONE', 
					'value'       => 'Europe/Madrid',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'MARGIN_METHOD', 
					'value'       => 'PRC',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'ALLOW_SALES_WITHOUT_STOCK', 
					'value'       => '0',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'ALLOW_SALES_RISK_EXCEEDED', 
					'value'       => '0',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_LANGUAGE', 
					'value'       => '1',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_PERCENT_DECIMALS', 
					'value'       => '2',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_COUNTRY_NAME', 
					'value'       => 'España',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_CUSTOMER_INVOICE_SEQUENCE', 
					'value'       => '0',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_CUSTOMER_INVOICE_TEMPLATE', 
					'value'       => '0',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_CUSTOMER_PAYMENT_METHOD', 
					'value'       => '0',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_OUTSTANDING_AMOUNT', 
					'value'       => '3000.0',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_CARRIER', 
					'value'       => '0',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_WAREHOUSE', 
					'value'       => '1',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_ITEMS_PERPAGE', 
					'value'       => '10',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),
			array(	'name'        => 'DEF_ITEMS_PERAJAX', 
					'value'       => '12',
					'created_at'  => \Carbon\Carbon::createFromDate(2015,03,31)->toDateTimeString(),
					'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
					),

		);

		// Uncomment the below to run the seeder
		DB::table('configurations')->insert($configurations);
	}

}
