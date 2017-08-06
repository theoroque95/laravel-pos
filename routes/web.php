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

// Auth::routes();

// Route::group(['middleware' => 'guest'], function () {
	// Route::get('/login', 'Auth/LoginController@showLoginForm');
	// Route::post('/login', 'Auth/LoginController@login');
	// Route::get('/register', 'Auth/RegisterController@showRegistrationForm');
	// Route::post('/register', 'Auth/RegisterController@create');
// });


// Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'DashboardController@show');

	// ADMIN
	Route::group(['prefix' => 'staff', 'as' => 'staff::'], function () {
	    Route::get('/', 'StaffController@show');
	    Route::get('/add', 'StaffController@add');
	    Route::post('/add', 'StaffController@create');
	    Route::get('/{id}', 'StaffController@edit');
	    Route::post('/{id}', 'StaffController@update');
	    Route::post('/{id}/changepassword', 'StaffController@changePassword');
	});

	Route::group(['prefix' => 'categories', 'as' => 'categories::'], function () {
	    Route::get('/', 'CategoriesController@show');
	    Route::get('/add', 'CategoriesController@add');
	    Route::post('/add', 'CategoriesController@create');
	    Route::get('/{id}', 'CategoriesController@edit');
	    Route::post('/{id}', 'CategoriesController@update');
	});

	Route::group(['prefix' => 'details', 'as' => 'details::'], function () {
	    Route::get('/', 'ProductDetailsController@show');
	    Route::get('/add', 'ProductDetailsController@add');
	    Route::post('/add', 'ProductDetailsController@create');
	    Route::get('/{id}', 'ProductDetailsController@edit');
	    Route::post('/{id}', 'ProductDetailsController@update');
	});
// });

Route::group(['prefix' => 'discounts', 'as' => 'discounts::'], function () {
    Route::get('/', 'DiscountsController@show');
    Route::get('/add', 'DiscountsController@add');
    Route::post('/add', 'DiscountsController@create');
    Route::get('/{id}', 'DiscountsController@edit');
    Route::post('/{id}', 'DiscountsController@update');
});