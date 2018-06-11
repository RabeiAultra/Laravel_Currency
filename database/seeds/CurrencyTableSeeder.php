<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $url =  "https://free.currencyconverterapi.com/api/v5/currencies";
      $json = json_decode(file_get_contents($url), true);
      $results=reset($json); //get the first item in array
      $bool=true;

      foreach($results as $item) { //iterative items
        $currency= new \App\Currency;
        $currency->name=$item['currencyName'];
        $currency->code=$item['id'];
        if(array_key_exists ('currencySymbol',$item)){
          $currency->symbol=$item['currencySymbol'];}
        else $currency->symbol="";
        $bool=$bool&$currency->save();
    }

  #  if($bool)print("All records have added");
  #  else  print("Some records have not been added ");
    }
}
