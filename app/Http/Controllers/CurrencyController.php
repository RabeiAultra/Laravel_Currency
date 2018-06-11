<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\Currency;
class CurrencyController extends Controller

{

public function index(){
  $currencies=Currency::all();
  $currencies = DB::table('currencies')->paginate();
return $currencies;
}



public function show($code){
  $model=Currency::Where('code',$code)->first();
  if(is_null($model))return "No code";

  $url =  "https://free.currencyconverterapi.com/api/v5/convert?q=USD_".$model->code."&compact=y";
  $json = json_decode(file_get_contents($url), true);
  $results=reset($json);
  return "value: ".$results['val'];
}

}
