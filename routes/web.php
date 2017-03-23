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

Route::get('/', ['as' => 'login','uses'=>'HomePageController@index']);
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