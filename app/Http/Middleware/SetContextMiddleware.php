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
		Context::getContext()->action     = NULL; //$action; 


		// Changing Timezone At Runtime
		Config::set('app.timezone', Configuration::get('TIMEZONE'));

		// Changing The Default Language At Runtime
		App::setLocale(Context::getContext()->language->iso_code); 


		return $next($request);
	}

}
