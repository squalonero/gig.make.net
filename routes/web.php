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



Route::get('/', function ()

{

    /*   if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {

        CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));

    }*/

    return view('login');

})->name('getLogin');

Route::get('/admin/login', function ()

{

    /*   if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {

        CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));

    }*/

    return view('login');

});



Route::get('firfiliale','FirfilialeController@index');

Route::get('admin/firfiliale','FirfilialeController@index');



Route::get('biglfiliali','BiglfilialeController@index');

Route::get('admin/biglfiliali','BiglfilialeController@index');



Route::get('biglpersonalizzati','BiglpersonalizzatiController@index');

Route::get('admin/biglpersonalizzati','BiglpersonalizzatiController@index');



Route::get('firpersonalizzate','FirpersonalizzateController@index');

Route::get('admin/firpersonalizzate','FirpersonalizzateController@index');





Route::get('gestfirme', 'GestfirmeController@index');

Route::get('admin/gestfirme', 'GestfirmeController@index');



Route::get('secondSelect', 'QueryController@secondSelect');



Route::any('getlayout', 'QueryController@getlayout');

Route::get('getnazioni', 'QueryController@getnazioni');

Route::get('getregioni', 'QueryController@getregioni');

Route::get('getprovince', 'QueryController@getprovince');

Route::get('getdivisioni', 'QueryController@getdivisioni');

Route::get('getfiliali', 'QueryController@getfiliali');

Route::get('getsocieta', 'QueryController@getsocieta');

Route::get('getfieldE', 'QueryController@getfieldE');



Route::get('getfield', 'QueryController@getfield');

Route::get('getLogoDivisione', 'QueryController@getLogoDivisione');

Route::get('setprof', 'QueryController@professione');

Route::get('setqta', 'QueryController@setqta');



Route::get('wfirma', 'WfirmaController@store');



Route::get('user', 'user\UserController@index');

Route::get('italia', 'user\ItaliaController@index');

Route::get('world', 'user\MondoController@index');



Route::get('admin/import', 'ImportController@index');

Route::post('admin/importcsv', 'ImportController@store');

Route::get('ordina', 'ImportController@ordina');

Route::get('/getsoc', 'QueryController@getsoc');

Route::get('/duplicarec', 'QueryController@duplica');

Route::get('/esporta', 'QueryController@esporta');

Route::get('/esportaOrdini', 'QueryController@esportaOrdini'); // nicpaola 07-2020



Route::get('/checkSponsorImage', 'QueryController@checkSponsorImage'); // nicpaola 07-2020



Route::get('sendbasicemail', 'MailController@basic_email');

Route::get('sendhtmlemail', 'MailController@html_email');

Route::get('sendattachmentemail', 'MailController@attachment_email');

Route::get('sendtestemail', 'MailController@test_email');



Route::get('viewbigli/{id}', 'ViewbigliController@index');



Route::get('approva/{id}', 'QueryController@approva');

