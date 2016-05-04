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

Route::group(['prefix' => 'api'], function (){

	Route::get('/', ['as' => 'api.index' , function () {
	    return view('api.index');
	}]);

	Route::get('practicantes', [
		'uses'	=>	'ApiController@practicantes',
		'as'	=>	'api.practicantes'
	]);

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	Route::get('/', ['as' => 'admin.index' , function () {
	    return view('admin.index');
	}]);	
    
	Route::resource('users','UsersController');
	Route::resource('categories','CategoriesController');
	Route::resource('tags','TagsController');
	Route::resource('articles','ArticlesController');
	Route::resource('practicantes', 'PracticantesController');
	Route::resource('pagos', 'PagosController');

	//Custom for Users 
	Route::get('users/{id}/destroy', [
		'uses' 	=> 	'UsersController@destroy',
		'as'	=>	'admin.users.destroy'
	]);

	//Custom for Categories 
	Route::get('categories/{id}/destroy', [
		'uses' 	=> 	'CategoriesController@destroy',
		'as'	=>	'admin.categories.destroy'
	]);

	//Custom for Tags 
	Route::get('tags/{id}/destroy', [
		'uses' 	=> 	'TagsController@destroy',
		'as'	=>	'admin.tags.destroy'
	]);

	//Custom for Articles 
	Route::get('articles/{id}/destroy', [
		'uses' 	=> 	'ArticlesController@destroy',
		'as'	=>	'admin.articles.destroy'
	]);

	//Custom for Practicantes 
	Route::get('practicantes/{id}/destroy', [
		'uses' 	=> 	'PracticantesController@destroy',
		'as'	=>	'admin.practicantes.destroy'
	]);

	//Custom for Pagos 
	Route::get('pagos/{id}/destroy', [
		'uses' 	=> 	'PagosController@destroy',
		'as'	=>	'admin.pagos.destroy'
	]);

	Route::get('pagos/{id}/create', [
		'uses' 	=> 	'PagosController@create',
		'as'	=>	'admin.pagos.create'
	]);
	
	Route::post('pagos/{id}', [
		'uses' 	=> 	'PagosController@store',
		'as'	=>	'admin.pagos.store'
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
