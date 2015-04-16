<?php

/*
|--------------------------------------------------------------------------
| Helper functions.
|--------------------------------------------------------------------------
|
| ToDo: move to a proper location; Google this: 
| "laravel 5 where to put helpers".
|
*/

function l($string = NULL, $data = [], $langfile = NULL)
	{
        if ($langfile == NULL) $langfile = \App\Context::getContext()->controller;

        if (Lang::has($langfile.'.'.$string))
			return Lang::get($langfile.'.'.$string, $data);
	//	elseif (Lang::has('_allcontrollers.'.$string))
	//		return Lang::get('_allcontrollers.'.$string);
		else 
		{
			foreach ($data as $key => $value)
			{
				$string = str_replace(':'.$key, $value, $string);
			}
			return $string;
		}
	}

function echo_r($foo)
	{
		echo '<pre>';
		print_r($foo);
		echo '</pre>';
	}
