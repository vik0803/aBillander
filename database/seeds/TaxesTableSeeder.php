<?php

use Illuminate\Database\Seeder;
use App\Tax as Tax;
  
class TaxesTableSeeder extends Seeder {
  
    public function run() {
        Tax::truncate();
  
        Tax::create( [
            'name'      => 'IVA Normal (21%)' ,
            'percent' => '21.0' ,
            'extra_percent' => '5.2' ,
            'active'    => '1' ,
                    'created_at'  => \Carbon\Carbon::createFromDate(2015,04,01)->toDateTimeString(),
                    'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
        ] );
  
        Tax::create( [
            'name'      => 'IVA Reducido (10%)' ,
            'percent' => '10.0' ,
            'extra_percent' => '1.4' ,
            'active'    => '1' ,
                    'created_at'  => \Carbon\Carbon::createFromDate(2015,04,01)->toDateTimeString(),
                    'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
        ] );
  
        Tax::create( [
            'name'      => 'IVA Super Reducido (4%)' ,
            'percent' => '4.0' ,
            'extra_percent' => '0.5' ,
            'active'    => '1' ,
                    'created_at'  => \Carbon\Carbon::createFromDate(2015,04,01)->toDateTimeString(),
                    'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
        ] );
  
        Tax::create( [
            'name'      => 'IVA Exento (0%)' ,
            'percent' => '0.0' ,
            'extra_percent' => '0.0' ,
            'active'    => '1' ,
                    'created_at'  => \Carbon\Carbon::createFromDate(2015,04,01)->toDateTimeString(),
                    'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
        ] );
    }
}
