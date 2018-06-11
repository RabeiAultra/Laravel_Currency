<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PullDataCurrenceis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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

    if($bool)print("All records have added");
    else  print("Some records have not been added ");

    }
}
