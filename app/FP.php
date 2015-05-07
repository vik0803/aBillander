<?php  namespace App;

use App;

// FormatterPresenter
class  FP {

    public static function date_short(\Carbon\Carbon $date, $format = '')
    {
        // http://laravel.io/forum/03-11-2014-date-format
        // https://laracasts.com/forum/?p=764-saving-carbon-dates-from-user-input/0

        if ($format == '') $format = \App\Configuration::get('DATE_FORMAT_SHORT');     // Should take value after User / Environment settings
        // echo ($format); die();
        // $date = \Carbon\Carbon::createFromFormat($format, $date);    
        // http://laravel.io/forum/03-12-2014-class-carbon-not-found?page=1

        // echo $date.' - '.Configuration::get('DATE_FORMAT_SHORT').' - '.$date->format($format); die();

        return $date->format($format);
    }

    public static function money($amount = 0, Currency $currency)
    {
        // $currency = Currency::find($currency_id);
        $number = number_format($amount, $currency->decimalPlaces, $currency->decimalSeparator, $currency->thousandsSeparator);

        $blank = $currency->blank ? ' ' : '';
        if ( $currency->signPlacement > 0 )
            $number = $number . $blank . $currency->sign;
        else
            $number = $currency->sign . $blank . $number;

        return $number;
    }

    public static function percent($percent = 0, $decimalPlaces = null)
    {
        if ( $decimalPlaces == null ) $decimalPlaces = Configuration::get('DEF_PERCENT_DECIMALS');
        $number = number_format($percent, $decimalPlaces, '.', '');

        return $number;
    }
}

