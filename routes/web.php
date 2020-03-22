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
    return view('welcome');
});

Route::get('groupe/create', function () {
    return view('groupe/create');
});
Route::get('groupe', 'GroupeController@show')->name('groupe');
Route::get('groupe/modify/{idGroupe}', 'GroupeController@showModify')->name('modify');
Route::get('groupe/create',function(){
    return view('groupe/createModify');
});
Route::post('groupe/create', 'GroupeController@create');
Route::post('groupe/modify/{idGroupe}', 'GroupeController@modify')->name('modify');
Route::get('groupe/delete/{idGroupe}', 'GroupeController@delete')->name('delete');


Route::get('individu', 'IndividuController@show')->name('individu');
Route::get('individu/create','IndividuController@showCreate');
Route::get('individu/modify/{idIndividu}', 'IndividuController@showModify')->name('modify');
Route::post('individu/create', 'IndividuController@create');
Route::post('individu/modify/{idIndividu}', 'IndividuController@modify')->name('modify');
Route::get('individu/delete/{idIndividu}', 'IndividuController@delete')->name('delete');

Route::get('appartenir/{idGroup}', 'AppartenirController@show')->name('appartenir');
Route::get('appartenir/gerer/{idGroup}', 'AppartenirController@showGerer')->name('gerer');
Route::post('appartenir/gerer/{idGroup}', 'AppartenirController@gerer')->name('gerer');
Route::get('appartenir/delete/{idGroup}/{idIndiv}', 'AppartenirController@delete')->name('delete');


Route::get('export/{extension}/{idGroup}', 'ExportController@export')->name('export');

Route::post('individu', 'IndividuController@importer')->name('importer');

Route::get('api/{idGroup}', 'ApiController@showJson')->name('json');