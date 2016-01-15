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


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	Route::get('/', ['as' => 'admin.index' , function () {
	    return view('admin.index');
	}]);
    
	Route::resource('users','UsersController');
	Route::resource('categories','CategoriesController');
	Route::resource('tags','TagsController');

	Route::get('users/{id}/destroy', [
		'uses' 	=> 	'UsersController@destroy',
		'as'	=>	'admin.users.destroy'
	]);

	Route::get('categories/{id}/destroy', [
		'uses' 	=> 	'CategoriesController@destroy',
		'as'	=>	'admin.categories.destroy'
	]);

	Route::get('tags/{id}/destroy', [
		'uses' 	=> 	'TagsController@destroy',
		'as'	=>	'admin.tags.destroy'
	]);
	
});


Route::get('admin/login', [
	'uses'	=>	'Auth\AuthController@getLogin',
	'as'	=>	'admin.auth.login'
]);

Route::post('admin/login', [
	'uses'	=>	'Auth\AuthController@postLogin',
	'as'	=>	'admin.auth.login'
]);

Route::get('admin/logout', [
	'uses'	=>	'Auth\AuthController@logout',
	'as'	=>	'admin.auth.logout'
]);
