<?php namespace App;

class Calculator {

    // PHP Margin Calculator
    public static function margin( $icst, $iprc ) 
    {
      if ( Configuration::get('MARGIN_METHOD') == 'CST' )  
      {  // margin sobre el precio de coste

         if ($icst==0) return NULL;

         $margin = ($iprc-$icst)/$icst;

      } else {
         // Default: sobre el precio de venta

         if ($iprc==0) return NULL;

         $margin = ($iprc-$icst)/$iprc;

      }
      return $margin;
    }

    // JavaScript Margin Calculator
    public static function marginJSCode( $withTags = NULL)
    {
        $jscode = '';

        if ( Configuration::get('MARGIN_METHOD') == 'CST' ) {   // {* Margen sobre el precio de coste *}
           $jscode .= "
               function margincalc(icst, iprc)
               {
                  var margin = 0;

                  if (icst==0) return '-';

                  margin = (iprc-icst)/icst;

                  return margin*100.0;
               }
               function pricecalc(icst, imc)
               {
                  var price = 0;

                  imc = imc/100.0;

                  price = icst*(1+imc);

                  return price;
               }";
        } else {                                                // {* Default: sobre el precio de venta *}
           $jscode .= "
               function margincalc(icst, iprc)
               {
                  var margin = 0;

                  if (iprc==0) return '-';

                  margin = (iprc-icst)/iprc;

                  return margin*100.0;
               }
               function pricecalc(icst, ims)
               {
                  var price = 0;

                  ims = ims/100.0;

                  if ((1-ims)==0) return '-';

                  price = icst/(1-ims);

                  return price;
               }";
        }
        if ($withTags) $jscode = '<script type="text/javascript">'."\n" . $jscode . "\n".'</script>';

        return $jscode;
    }
	
}