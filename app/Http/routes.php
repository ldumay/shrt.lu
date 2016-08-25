<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Web Routes
 */

Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@index'
]);

Route::post('/create', [
    'as' => 'create',
    'uses' => 'LinkController@create'
]);

Route::get('/{slug}', [
    'as' => 'get',
    'uses' => 'LinkController@get'
]);

Route::get('/stats/{slug}', [
    'as' => 'stats',
    'uses' => 'StatController@view'
]);

/*
 * Doc Routes
 */

Route::get('/doc/api', function (){
    return view('doc.api');
});

/*
 * API Routes
 */

Route::get('/api/create', [
    'as' => 'api.create.get',
    'uses' => 'ApiController@create',
]);