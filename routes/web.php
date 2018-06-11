<?php



Route::get('/', function () {
    return view('currency');
});





Route::resource("currency","CurrencyController");


Route::resource("currency/code","CurrencyController@show");
