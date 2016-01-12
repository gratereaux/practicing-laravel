<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nombre/{nombre?}', function($nombre = ""){
	return ('Hola '.$nombre);
});

Route::get('/articles', function(){
	return ('Articles');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => 'article'], function () {
    
	Route::get('view/{id}', [

		'uses' 	=> 'TestController@view',
		'as' 	=> 'articlesViews'

	]);

});


Route::group(['prefix' => 'admin'], function () {
    
	Route::resource('users','UsersController');

	Route::get('users/{id}/destroy', [
		'uses' 	=> 	'UsersController@destroy',
		'as'	=>	'admin.users.destroy'
	]);

	
});