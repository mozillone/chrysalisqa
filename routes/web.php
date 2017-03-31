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
//Auth::routes();
    
Route::get('/', ['as' => '','uses'=>'HomePageController@index']);
Route::get('/login', ['as' => 'login','uses'=>'AuthController@getSignin']);
Route::post('/login', ['as' => 'login.post','uses'=>'AuthController@postLogin']);
Route::post('/register', ['as' => 'register','uses'=>'AuthController@postRegisterUser']);
Route::any('admin', 'AuthController@getAdminSignin');
Route::post('/admin/login', ['as' => 'admin.login.post','uses'=>'AuthController@postAdminSignin']);
Route::get('social/login/redirect/{provider}', ['uses' => 'AuthController@redirectToProvider', 'as' => 'social.login']);
Route::get('social/login/{provider}', 'AuthController@handleProviderCallback');
Route::get('/logout', ['as' => 'logout','uses'=>'AuthController@logout']);
Route::get('/verification/{verification}', ['as' => '','uses'=>'AuthController@verification']);
Route::any('/forgetPassword', ['as' => 'forgotpassword.post','uses'=>'AuthController@forgotPassword']);
Route::any('/password/change/{verification?}', ['as' => 'forgotpassword.change','uses'=>'AuthController@forgotPasswordChange']);
Route::any('/emailValidation', array('as' => '','uses' => 'AuthController@EmailNameCheck'));
Route::any('/forgot/emailVerification', array('as' => '','uses' => 'AuthController@forgorpasswordEmailCheck'));
Route::get('/dashboard', ['as' => 'dashboard','uses'=>'DashboardController@dashboard']);
Route::any('/edit/profile', ['as' => 'edit-profile','uses'=>'UserController@EditProfile']);

/** Products list page start here **/
Route::any('/shop/{slug1}/{slug2?}', array('as' => '','uses' => 'CostumesController@costumeListings'));
Route::any('/shop/{slug1}/{slug2?}/{slug3?}', array('as' => '','uses' => 'CostumesController@costumeSingleView'));
/** Products list page end here **/

Route::group(['namespace' => 'Admin', 'middleware' => 'admin',], function() {
	  	Route::get('/admin/dashboard', 'DashboardController@dashboard');
	  	Route::get('/admin/profile', 'UserController@adminProfile');
	  	Route::post('/admin/profile/post', ['as' => 'admin-profile-update','uses'=>'UserController@adminProfileUpdate']);
	   /****************User Management Start Here***************************/
	    Route::get('customers-list', ['as' => 'customers-list','uses'=>'UserController@customersList']);
	    Route::any('/customers/list', 'UserController@customersListData');
	    Route::any('/customer-add', ['as' => 'customer-create','uses'=>'UserController@customerAdd']);
	    Route::any('/customer-edit/{id}', ['as' => '','uses'=>'UserController@customerEdit']);
	    Route::any('/customer-update', ['as' => 'customer-update','uses'=>'UserController@customerUpdated']);
	    Route::any('/customer-delete/{id}', 'UserController@customerDelete');
	    Route::any('/status/change', 'UserController@changeUserStatus');
	    Route::any('/customer/emailValidation', array('as' => '','uses' => 'UserController@EmailNameCheck'));
	    /****************User Management End Here***************************/
});

