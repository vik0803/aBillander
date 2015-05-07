<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('language/{id}', 'WelcomeController@setLanguage');

Route::get('home', 'HomeController@index');

Route::get('404', function()
{
	return View::make('errors.404');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



/* ********************************************************** */


// Secure-Routes
Route::group(['middleware' => 'auth'], function()
{
	// Route::get( 'contact', 'ContactMessagesController@create');
	Route::post('contact', 'ContactMessagesController@store');


	// See: https://gist.github.com/drawmyattention/8cb599ee5dc0af5f4246
	Route::group(array('middleware' => 'authAdmin'), function()
	{
		Route::resource('companies', 'CompaniesController');
		
		Route::resource('configurations', 'ConfigurationsController');
		Route::resource('configurationkeys', 'ConfigurationKeysController');

		Route::resource('languages', 'LanguagesController');

//		Route::resource('sequences', 'SequencesController');

		Route::resource('users', 'UsersController');

//		Route::resource('templates', 'TemplatesController');

		Route::resource('currencies', 'CurrenciesController');

		Route::resource('taxes', 'TaxesController');

		Route::resource('categories', 'CategoriesController');

		Route::resource('products', 'ProductsController');
		Route::post('products/{id}/combine', array('as' => 'products.combine', 'uses'=>'ProductsController@combine'));
		Route::get('products/ajax/name_lookup'  , array('uses' => 'ProductsController@ajaxProductSearch', 
														'as'   => 'products.ajax.nameLookup' ));
		Route::post('products/ajax/options_lookup'  , array('uses' => 'ProductsController@ajaxProductOptionsSearch', 
														'as'   => 'products.ajax.optionsLookup' ));
		
		Route::resource('optiongroups',         'OptionGroupsController');
		Route::resource('optiongroups.options', 'OptionsController');;

		Route::resource('combinations', 'CombinationsController');

		Route::resource('warehouses', 'WarehousesController');

		Route::resource('stockmovements', 'StockMovementsController');
	});


});


/* ********************************************************** */

Route::get('test', function()
{
	echo \Carbon\Carbon::now();

	echo Config::get('app.timezone'). \App\Configuration::get('TIMEZONE');
});