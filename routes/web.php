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
//Route::any('/shop/{cat_id}/{slug1}/{slug2?}', array('as' => '','uses' => 'CostumesController@costumeListings'));
//Route::any('/shop/{cat_id}/{slug1}/{slug2?}/{slug3?}', array('as' => '','uses' => 'CostumesController@costumeSingleView'));
Route::get('/category/{slug1}/{slug2}', array('as' => '','uses' => 'CostumesController@costumeListings'))->where('name', '[A-Za-z]+');;
Route::any('/shop/{cat_id}/{slug1}/{slug2?}/{slug3?}', array('as' => '','uses' => 'CostumesController@costumeSingleView'));
Route::any('/getCostumesData', array('as' => '','uses' => 'CostumesController@getCostumesData'));
/** Products list page end here **/

Route::any('/costume-report', array('as' => 'report.post','uses' => 'CostumesController@costumeReport'));

/*******************Car Functionality stat here *********/
Route::any('/addToCart', array('as' => 'report.post','uses' => 'CartController@addToCart'));
/*******************Car Functionality end here *********/


/** Costumes Controller startsend here **/


/** Costume Like page start here **/
Route::any('/costume/like', array('as' => '','uses' => 'CostumesController@costumeLike'));
/** Costume Like page end here **/
/****costume create page 2 routes starts here***/
Route::any('/costume/sell-a-costume', array('as' => '','uses' => 'CreateCostumeController@sellCostume'));
Route::any('/costume/createone', array('as' => '','uses' => 'CreateCostumeController@createCostumestep1'));
Route::any('/costume/createtwo', array('as' => '','uses' => 'CreateCostumeController@createCostumestep2'));
Route::any('/costume/createthree', array('as' => '','uses' => 'CreateCostumeController@createCostumestep3'));
Route::any('/costume/createfour', array('as' => '','uses' => 'CreateCostumeController@createCostumestep4'));
Route::any('/costume/ajaxsubcategory', array('as' => '','uses' => 'CreateCostumeController@ajaxSubCategory'));

Route::any('/costume/costumecreate', array('as' => '','uses' => 'CreateCostumeController@Costumecreate'));
/****costume create page 2 code ends here***/

/** Costume Like page start here **/
Route::any('/costume/favourite', array('as' => '','uses' => 'CostumesController@costumeFavourite'));
/** Costume Like page end here **/

Route::get('/wishlist', ['as' => 'wishlist','uses'=>'WishlistCostumesController@myWishlistList']);
Route::get('/remove/wishlist/{costume_id}', ['as' => '','uses'=>'WishlistCostumesController@removeWishlistCostume']);




	Route::group(['namespace' => 'Admin', 'middleware' => 'admin',], function() {
	  	Route::get('/admin/dashboard', 'DashboardController@dashboard');
	  	Route::get('/admin/profile', 'UserController@adminProfile');
	  	Route::post('/admin/profile/post', ['as' => 'admin-profile-update','uses'=>'UserController@adminProfileUpdate']);
	   /****************User Management Start Here***************************/
	    Route::get('customers-list', ['as' => 'customers-list','uses'=>'UserController@customersList']);
	    Route::any('/customers/list', 'UserController@customersListData');
		Route::get('/user-costumes-list/{id}', ['as' => 'user-costumes-list','uses'=>'UserController@userCostumes']);
		Route::get('/user-costumessold-list/{id}', ['as' => 'user-costumessold-list','uses'=>'UserController@userSoldcostumes']);
		Route::get('/user-recentorders-list/{id}', ['as' => 'user-recentorders-list','uses'=>'UserController@recentOrders']);
	    Route::get('/user-credithistory-list/{id}', ['as' => 'user-credithistory-list','uses'=>'UserController@creditHistory']);
		Route::get('/user-payementprofiles-list/{id}', ['as' => 'user-payement_profiles-list','uses'=>'UserController@payementProfiles']);
		Route::any('/customer-add', ['as' => 'customer-create','uses'=>'UserController@customerAdd']);
	    Route::any('/customer-edit/{id}', ['as' => '','uses'=>'UserController@customerEdit']);
	    Route::any('/customer-update', ['as' => 'customer-update','uses'=>'UserController@customerUpdated']);
	    Route::any('/customer-delete/{id}', 'UserController@customerDelete');
	    Route::any('/status/change', 'UserController@changeUserStatus');
	    Route::any('/customer/emailValidation', array('as' => '','uses' => 'UserController@EmailNameCheck'));
	    /****************User Management End Here***************************/

		/****************Costumes Management Code Starts Here*********************/
		Route::any('/costumes/create', ['as' => 'costumes-create','uses'=>'CostumeController@createCostume']);
		Route::post('/upload', ['as' => 'image.store' , 'uses' => 'CostumeController@post_upload']);
		Route::get('costumes-list', ['as' => 'costumes-list','uses'=>'CostumeController@costumesList']);
		Route::any('costumes-insert', ['as' => 'costumes-insert','uses'=>'CostumeController@insertCostume']);
		Route::get('/reported/costumes', ['as' => 'reported-costumes-list','uses'=>'CostumeController@getReportedCostumes']);
		Route::any('/costume-reports-list', ['as' => '','uses'=>'CostumeController@getReportedCostumesData']);
		/****************Costumes Managemnet Code Ends Here***********************/

		/****************Attributes Management Starts Here*********************/
		Route::any('/attributes/create', ['as' => 'attributes-create','uses'=>'AttributeController@createAttributes']);
	    Route::any('/attribute/edit/{id?}', ['as' => 'attribute-edit','uses'=>'AttributeController@editAttribute']);
	    Route::any('/attribute-delete/{id}', ['as' => '','uses'=>'AttributeController@deleteAttributes']);
	    Route::any('/attributes', ['as' => 'attributes-list','uses'=>'AttributeController@attributesList']);
	    Route::any('/attributes-list', ['as' => '','uses'=>'AttributeController@attributesData']);
	
		Route::any('/attributes/value/create', ['as' => 'attribute-value-create','uses'=>'AttributeController@createAttributesValue']);
	    Route::any('/attribute/value/edit/{id?}', ['as' => 'attribute-value-edit','uses'=>'AttributeController@editAttributeValue']);
	    Route::any('/attribute-value-delete/{id}', ['as' => '','uses'=>'AttributeController@deleteAttributesValue']);
	    Route::any('/attributes/values', ['as' => 'attributes-values-list','uses'=>'AttributeController@attributesValuesList']);
	    Route::any('/attributes-values-list', ['as' => '','uses'=>'AttributeController@attributesValuesData']);
		/****************Attributes Management Ends Here***********************/


		/****************Categories Management Starts Here*********************/
		Route::any('/category/create', ['as' => 'categories-create','uses'=>'CategoriesController@createCategories']);
	    Route::any('/categories/edit/{id?}', ['as' => 'categories-edit','uses'=>'CategoriesController@editCategories']);
	    Route::any('/category-delete/{id}', ['as' => '','uses'=>'CategoriesController@deleteCategory']);
	    Route::any('/categories', ['as' => 'categories-list','uses'=>'CategoriesController@categoriesList']);
	    Route::any('/categories-list', ['as' => '','uses'=>'CategoriesController@categoriesData']);
	    Route::any('/getCostumesList', ['as' => '','uses'=>'CategoriesController@getCostumesList']);
		/****************Categories Management Ends Here***********************/

		/****************Promotions Management Starts Here*********************/
		Route::any('/promotion/create', ['as' => 'promotion-create','uses'=>'PromotionsController@createPromotions']);
	    Route::any('/promotion/edit/{id?}', ['as' => 'promotion-edit','uses'=>'PromotionsController@editPromotions']);
	    Route::any('/promotion-delete/{id}', ['as' => '','uses'=>'PromotionsController@deletePromotion']);
	    Route::any('/promotions', ['as' => 'promotions-list','uses'=>'PromotionsController@promotionsList']);
	    Route::any('/promotions-list', ['as' => '','uses'=>'PromotionsController@promotionsData']);
	    Route::any('/promotion/status/change', ['as' => '','uses'=>'PromotionsController@changePromotionStatus']);
	    Route::any('/getSelectedCategories/{cat_id}', ['as' => '','uses'=>'PromotionsController@getSelectedCategories']);
       /****************Promotions Management Ends Here***********************/


       	/****************Charities Management Starts Here*********************/
		Route::any('/charity/create', ['as' => 'charity-create','uses'=>'CharitiesController@createCharity']);
	    Route::any('/charity/edit', ['as' => 'charity-edit','uses'=>'CharitiesController@editCharity']);
	    Route::any('/charity-delete/{id}', ['as' => '','uses'=>'CharitiesController@deleteCharity']);
	    Route::any('/charities', ['as' => 'charities-list','uses'=>'CharitiesController@charitiesList']);
	    Route::any('/charities-list', ['as' => '','uses'=>'CharitiesController@charitiesData']);
	    Route::any('/charity/status/change', ['as' => '','uses'=>'CharitiesController@changeCharityStatus']);
	   /****************Charities Management Ends Here***********************/




});

