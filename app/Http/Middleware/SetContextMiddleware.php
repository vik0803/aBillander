<?php namespace App\Http\Middleware;

use Closure;

use App\Configuration as Configuration;
use App\Company as Company;
use App\Context as Context;
use App\Language as Language;
use Illuminate\Support\Str as Str;
use Auth;
use App\User as User;
use Config, App;
use Request;
// use \Illuminate\Support\Str;

class SetContextMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		/*
		|--------------------------------------------------------------------------
		| Application Configuration
		|--------------------------------------------------------------------------
		|
		| Load Configuration Keys.
		|
		*/

		Configuration::loadConfiguration();

		if ( Auth::check() )
		{
			$user = User::with('language')->find( Auth::id() );		// $email = Auth::user()->email;
			$language = $user->language;
		} else {
			$user = NULL;
			$language = Language::find( intval(Request::cookie('user_language')) );
			if ( !$language )
				$language = Language::findOrFail( intval(Configuration::get('DEF_LANGUAGE')) );
		}

		$company = Company::with('currency')->findOrFail( intval(Configuration::get('DEF_COMPANY')) );

		Context::getContext()->user       = $user;
		Context::getContext()->language   = $language;

		Context::getContext()->company    = $company;
		Context::getContext()->currency   = $company->currency;

		Context::getContext()->controller = $request->segment(1);
		if ($request->segment(3) == 'attributes') Context::getContext()->controller = $request->segment(3);
		Context::getContext()->action     = NULL; //$action; 
/* * /
		// echo_r($request->route()->getAction());
		// http://laravel.io/forum/10-15-2014-laravel-5-passing-parameters-to-middleware-handlers
		// http://www.codeheaps.com/php-programming/laravel-5-middleware-stack-decoded/
		// http://blog.elliothesp.co.uk/coding/passing-parameters-middleware-laravel-5/
		// https://gist.github.com/dwightwatson/6200599
		// http://stackoverflow.com/questions/26840278/laravel-5-how-to-get-route-action-name
		    $action = $request->route()->getAction();
		    $routeArray = Str::parseCallback($action['controller'], null);

		    if (last($routeArray) != null) {
		        // Remove 'controller' from the controller name.
		        $controller = str_replace('Controller', '', class_basename(head($routeArray)));

		        // Take out the method from the action.
		        $action = str_replace(['get', 'post', 'patch', 'put', 'delete'], '', last($routeArray));

		        // return Str::slug($controller . '-' . $action);
		    } else {
		        // return 'closure';
		        $controller = 'closure';
		        $action = '';
		    }
		// gist ENDS

		Context::getContext()->controller = $controller;
		Context::getContext()->action     = $action; 
		echo Str::slug($controller . '-' . $action);
/ * */

		// Changing Timezone At Runtime. But this change does not seem to be taken by Carbon... Why?
		Config::set('app.timezone', Configuration::get('TIMEZONE'));

		// Changing The Default Language At Runtime
		App::setLocale(Context::getContext()->language->iso_code); 


		return $next($request);
	}

}
