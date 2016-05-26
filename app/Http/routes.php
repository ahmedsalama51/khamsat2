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
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

 Route::group(['middleware' => ['web']], function () {

	Route::get('/', 'PagesControllers@index');
	Route::post('/search', 'PagesControllers@search');
	Route::get('about', 'PagesControllers@about');
		// prevented action to only loged active users
		Route::group(['middleware' => ['auth','active']], function () {
			/******************* post action *******************/
			// add post
			Route::get('posts/add', 'PostControllers@add');
			Route::post('posts/add', 'PostControllers@store');
			//edit post
			Route::get('edit/{post}', 'PostControllers@edit');
			Route::put('edit/{post}', 'PostControllers@append');
			//delete post
			Route::get('delete/{post}', 'PostControllers@destroy');
			/******************* user action *******************/
			Route::get('user/edit/{user}', 'UserControllers@edit');
			Route::put('user/edit/{user}', 'UserControllers@append');
			/******************* comment action *******************/
			//add comment
			Route::post('comments/add/{post}', 'CommentController@store');
			Route::post('comment/edit/{post}/{comment}', 'CommentController@append');
		});
	//categories rooutes
	Route::get('categories/{id}', 'CategoryController@show');
	// Route::get('category/add', 'CategoryController@add');
	Route::get('category/add', 'CategoryController@store');
	Route::put('categories/{id}/edit', 'CategoryController@edit');
	Route::get('cat/controle/{post}', 'CategoryController@controle');
	//tags rooutes
	Route::get('tags/{id}', 'TagController@show');
	Route::put('tags/{id}/edit', 'TagController@edit');
	Route::delete('tags/{id}', 'TagController@destroy');

	//post routes ...
	Route::get('posts/{post}/{title}', 'PostControllers@show');

	
	Route::get('controle/{post}', 'PostControllers@controle');
	// Route::delete('posts/{post}', 'PostControllers@destroy');

	//user routes...
	Route::get('users/{user}', 'UserControllers@show');

	// Route::get('user/deactive/{user}', 'UserControllers@deactive');
	// Route::get('user/reactive/{user}', 'UserControllers@reactive');
	Route::get('user/controle/{user}', 'UserControllers@control');



	Route::auth();
	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');

	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	// Vertify account using mail
	Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\AuthController@confirm'
	]);
	Route::controllers([
	   'password' => 'Auth\PasswordController',
	]);
//admin routs
	Route::group(['middleware' => ['auth','active','admin']], function () {
    	// return "this page requires that you be logged in and an Admin";
    	Route::get('/admin', 'UserControllers@admin');
	});

 });

