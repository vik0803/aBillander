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

		Route::resource('sequences', 'SequencesController');

		Route::resource('users', 'UsersController');

		Route::resource('templates', 'TemplatesController');

		Route::resource('currencies', 'CurrenciesController');
	});


});


/* ********************************************************** */

