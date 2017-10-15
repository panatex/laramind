<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('anagrafica-clienti.index');
});

//crud anagrafica clienti
//nel prefisso no trailinh slash
//nei sotto slash in testa
Route::group(['prefix' => '/anagrafica-clienti'], function () {
    Route::get('/', 'AnagraficaClienteController@index')->name('anagrafica-clienti.index');
    Route::get('/create', 'AnagraficaClienteController@create')->name('anagrafica-clienti.create');
    //il where mi fa lanciare una eccezzioine se uno scrivere del testo e non solo numeri
    //? nel parametro alla fine solo se opzionale e se opzionael nel metodo mettere null come valore di default
    Route::get('/show/{id}', 'AnagraficaClienteController@show')->name('anagrafica-clienti.show')->where('id', '[0-9]+');
    Route::post('/store', 'AnagraficaClienteController@store')->name('anagrafica-clienti.store');
    Route::get('/update/{id}', 'AnagraficaClienteController@update')->name('anagrafica-clienti.update')->where('id', '[0-9]+');
    Route::post('/updateApply/{id}', 'AnagraficaClienteController@updateApply')->name('anagrafica-clienti.updateApply');
    Route::get('/delete/{id}', 'AnagraficaClienteController@delete')->name('anagrafica-clienti.delete')->where('id', '[0-9]+');


});

Route::post('/test-middleware', function () {
    return "eseguito";
})->middleware('verify-custom');


Route::get('/test-middleware', function () {
    return "eseguito";
})->middleware('verify-custom');

// === esempio di creazinoe maschera JS based
Route::get('/maschera-javascript','AnagraficaClienteController@mascheraJavascript')->name('maschera.home');

//=== api esterna
Route::get('/webservice-call', 'WebServicesController@externalCall');
//=== api esterna post
Route::get('/webservice-call-post', 'WebServicesController@externalCall_makePost');
//esempio di gestione eventi
Route::get('/invoca-invia-notifica','AnagraficaClienteController@inviaNotifica');