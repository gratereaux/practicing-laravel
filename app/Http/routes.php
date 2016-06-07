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
    return view('welcome')->with('chart', ['chart1' => [	
	    										[10, 'red', 'Label 1'],
	    										[11, 'blue', 'Label 2'],
	    										[15, 'green', 'Label 3'],
	    										[21, 'brown', 'Label 4'],
	    										[30, 'grey', 'Label 5'],
	    										[14, 'purple', 'Label 6']
    									  	],
    									  	'chart2' => [	
	    										["Hola Mundo 1", "purple" ,[65, 59, 90, 81, 56, 55, 40]],
	    										["Hola Mundo 2", "red", [28, 48, 40, 19, 96, 27, 100]]
    									  	],
    									  ]);
});

Route::get('/buy', function(){
	return view("stripe.index");
});

Route::post('/buy', function(){
	$billing = App::make('App\Billing\BillingInterface');
	
	$billing->charge([
		'email' => $_POST['email'],
		'onetime' => $_POST['onetime'],
		'token' => $_POST['stripe-token']
	]);

	return "Charge was successful";

});

Route::group(['middleware' => ['web']], function(){

	Route::get('/nombre/{nombre?}', function($nombre = ""){
		return ('Hola '.$nombre);
	});



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

Route::group(['prefix' => 'article', 'middleware' => ['web']], function () {
    
	Route::get('view/{id}', [

		'uses' 	=> 'TestController@view',
		'as' 	=> 'articlesViews'

	]);

});

Route::group(['prefix' => 'api', 'middleware' => ['web']], function (){

	Route::get('/', ['as' => 'api.index' , function () {
	    return view('api.index');
	}]);

	Route::get('practicantes', [
		'uses'	=>	'ApiController@practicantes',
		'as'	=>	'api.practicantes',
		'middleware' => 'apiAuth'
	]);
	Route::get('practicantes/{id}', [
		'uses' 	=> 	'ApiController@byId',
		'as'	=>	'api.byId',
		'middleware' => 'apiAuth'
	]);
	Route::get('articlesCat/{cat}', [
		'uses' 	=> 	'ApiController@articlesCat',
		'as'	=>	'api.articlesCat'
	]);
	Route::get('articlesTag/{tag}', [
		'uses' 	=> 	'ApiController@articlesTag',
		'as'	=>	'api.articlesTag'
	]);
	Route::get('categories', [
		'uses' 	=> 	'ApiController@categories',
		'as'	=>	'api.categories'
	]);

	Route::get('tags', [
		'uses' 		 => 	'ApiController@tags',
		'as'		 =>		'api.tags'
	]);

	Route::get('users', [
		'uses' 		 => 	'ApiController@users',
		'as'		 =>		'api.users',
		'middleware' => 'apiAuth'
	]);

	Route::get('users/{user}', [
		'uses' 	=> 	'ApiController@user',
		'as'	=>	'api.user',
		'middleware' => 'apiAuth'
	]);	

	Route::get('ranks', [
		'uses' 	=> 	'ApiController@ranks',
		'as'	=>	'api.ranks'
	]);	

	Route::get('dojos', [
		'uses' 	=> 	'ApiController@dojos',
		'as'	=>	'api.dojos'
	]);	

});

Route::group(['prefix' => 'practicante', 'middleware' => ['web','auth']], function () {

	Route::resource('tecnicas','TecnicasController');
	Route::resource('pagos', 'PagosPracticantesController');

});


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

	Route::get('/', ['as' => 'admin.index' , function () {
	    return view('admin.index');
	}]);	

	Route::group(['middleware' => 'onlyAdmin'], function(){
		Route::resource('tags','TagsController');
		Route::resource('categories','CategoriesController');
		Route::resource('articles','ArticlesController');
		Route::resource('practicantes', 'PracticantesController');
		Route::resource('pagos', 'PagosController');
		Route::resource('users','UsersController');
	});
	



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

Route::get('admin/register', [
	'uses'	=>	'Auth\AuthController@register',
	'as'	=>	'admin.auth.register'
]);

Route::post('admin/register', [
	'uses'	=>	'Auth\AuthController@postregister',
	'as'	=>	'admin.auth.register'
]);

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
