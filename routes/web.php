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
//Route::get('costume/redirect/{id}','');
Route::any('costume/redirect/{id}', 'CreateCostumeController@redirectToCharity');

Route::get('sitemap',['as' => 'sitemaps.posts','uses'=> 'SitemapsController@index']);
Route::get('stripeuserupdate/{email}', ['as' => 'stripe.userupdate','uses'=> 'SitemapsController@stripeUsersUpdate']);
Route::get('update/subcategories/attributes', ['as' => 'update.subcategories.attributes','uses'=> 'SitemapsController@updateAttributesForSubcategories']);
   
Route::get('/', ['as' => '','uses'=>'HomePageController@index']);
Route::get('/login', ['as' => 'login','uses'=>'AuthController@getSignin']);
Route::post('/login', ['as' => 'login.post','uses'=>'AuthController@postLogin']);
Route::post('/register', ['as' => 'register','uses'=>'AuthController@postRegisterUser']);
Route::any('admin', 'AuthController@getAdminSignin');
Route::post('/admin/login', ['as' => 'admin.login.post','uses'=>'AuthController@postAdminSignin']);
Route::get('social/login/redirect/{provider}', ['uses' => 'AuthController@redirectToProvider', 'as' => 'social.login']);
Route::any('social/login/{provider}', 'AuthController@handleProviderCallback');
Route::get('/logout', ['as' => 'logout','uses'=>'AuthController@logout']);
Route::get('/verification/{verification}', ['as' => '','uses'=>'AuthController@verification']);
Route::any('/forgetPassword', ['as' => 'forgotpassword.post','uses'=>'AuthController@forgotPassword']);
Route::get('/admin/forgotpassword', ['as' => 'admin.forgotpassword','uses'=>'AuthController@adminForgotPassword']);
Route::post('/admin/forgotpassword', ['as' => 'admin.forgotpassword.post','uses'=>'AuthController@adminForgotPasswordPost']);
Route::any('/password/change/{verification?}', ['as' => 'forgotpassword.change','uses'=>'AuthController@forgotPasswordChange']);
Route::any('/admin/password/change/{verification?}', ['as' => 'admin.forgotpassword.change','uses'=>'AuthController@adminForgotPasswordChange']);
Route::any('/emailValidation', array('as' => '','uses' => 'AuthController@EmailNameCheck'));
Route::any('/usernameValidation', array('as' => '','uses' => 'AuthController@UserNameCheck'));
Route::any('/forgot/emailVerification', array('as' => '','uses' => 'AuthController@forgorpasswordEmailCheck'));
Route::get('/dashboard', ['as' => 'dashboard','uses'=>'DashboardController@dashboard']);
Route::any('/edit/profile', ['as' => 'edit-profile','uses'=>'DashboardController@EditProfile']);
Route::any('/shipping-details', ['as' => 'shipping-details','uses'=>'DashboardController@ShippingDetails']);
Route::any('/addshippingaddress', ['as' => 'shipping-address','uses'=>'DashboardController@addShippingAddress']);
Route::any('/addbillingaddress', ['as' => 'billing-address','uses'=>'DashboardController@addBillingAddress']);
Route::any('/seller/location/address', ['as' => 'seller-location-address','uses'=>'DashboardController@sellerLocationAddress']);
Route::any('deleteSellerAddress/{id}', ['as' => '','uses'=>'DashboardController@deletSellerLocationAddress']);
Route::any('/deleteaddress/{id}', ['as' => '','uses'=>'DashboardController@deleteAddress']);
Route::any('/deleteccard/{id}', ['as' => '','uses'=>'DashboardController@Deleteccard']);
Route::any('/creditcardadd', ['as' => 'creditcard-add','uses'=>'DashboardController@creditcradAdd']);
Route::any('/allorders', ['as' => 'allorders','uses'=>'DashboardController@allOrders']);
Route::post('/ccupdate', ['as' => '','uses'=>'DashboardController@ccUpdate']);
Route::post('/emailcheck', ['as' => '','uses'=>'DashboardController@emailCheck']);
Route::get('/test', ['as' => '','uses'=>'DashboardController@Test']);
Route::post('/test', ['as' => 'test','uses'=>'DashboardController@PostTest']);

/** Products list page start here **/
Route::any('/category/{slug1}/{page?}', array('as' => '','uses' => 'CostumesController@categoryCostumeListings'))->where('name', '[A-Za-z]+');;

Route::any('/Filterscategory/{slug1}','CostumesController@searchFilters');

Route::get('/category/{slug1}/{slug2}', array('as' => '','uses' => 'CostumesController@costumeListings'))->where('name', '[A-Za-z]+');;
Route::any('/product/{slug1?}/{slug2?}/{slug3?}', array('as' => '','uses' => 'CostumesController@costumeSingleView'));


Route::any('/getCostumesData', array('as' => '','uses' => 'CostumesController@getCostumesData'));
Route::any('inquire-costume', array('as' => 'inquire-costume','uses' => 'CostumesController@inquireCostume'));
/** Products list page end here **/

Route::any('/costume-report', array('as' => 'report.post','uses' => 'CostumesController@costumeReport'));

/*******************Car Functionality stat here *********/
Route::any('/addToCart', array('as' => '','uses' => 'CartController@addToCart'));
Route::any('/cart', array('as' => 'cart','uses' => 'CartController@cart'));
Route::any('/updateCart', array('as' => 'Update.Cart','uses' => 'CartController@updateCart'));
Route::any('/cart/delete/{cart_item_id}/{cart_id}', array('as' => '','uses' => 'CartController@productRemoveFromCart'));
Route::any('/store_credits/update', array('as' => '','uses' => 'CartController@storeCreditsUpdate'));
Route::get('/getMiniCartProducts', array('as' => '','uses' => 'CartController@getMiniCartProducts'));

/*******************Car Functionality end here \*********/

/*******************Checkout Functionality stat here *********/
Route::any('checkout', array('as' => '','uses' => 'CheckoutController@checkout'));
Route::any('/checkout/placeorder', array('as' => 'place-order','uses' => 'CheckoutController@placeOrder'));
Route::post('/add/credit-card', array('as' => 'add-credit-card','uses' => 'CheckoutController@addCreditCard'));
Route::post('/add/shipping-adress', array('as' => 'shipping_address.post','uses' => 'CheckoutController@addShippingAddress'));
Route::post('/add/billing-adress', array('as' => 'billing_address.post','uses' => 'CheckoutController@addBillingAddress'));



Route::any('/buy-it-now/{costume_id?}', array('as' => 'buy-it-now','uses' => 'CheckoutController@buyItNow'));
Route::any('/get/credit-card/{card_id?}', array('as' => 'add-credit-card','uses' => 'CheckoutController@getCreditCard'));
Route::get('/get-adress/{type?}/{address_id?}', array('as' => 'shipping_address.post','uses' => 'CheckoutController@getAddressInfo'));
Route::any('/orders/charity/fund', array('as' => 'orders-charity-fund','uses' => 'CheckoutController@orderCharityFund'));
Route::any('/orders/charity', array('as' => '','uses' => 'CheckoutController@orderCharityRedirect'));
Route::any('/get/credit-card', array('as' => 'add-credit-card','uses' => 'CheckoutController@getCreditCard'));
Route::any('/any/shipping-adress', array('as' => 'shipping_address.post','uses' => 'CheckoutController@getShippingAddress'));
Route::any('/get/billing-adress', array('as' => 'billing_address.post','uses' => 'CheckoutController@getBillingAddress'));
/*******************Checkout Functionality end here *********/



/** Costumes Controller startsend here **/


/** Costume Like page start here **/
Route::any('/costume/like', array('as' => '','uses' => 'CostumesController@costumeLike'));
/** Costume Like page end here **/
/****costume create page 2 routes starts here***/
Route::any('/costume/sell-a-costume', array('as' => '','uses' => 'CmsController@viewSellACostume'));
Route::any('/costume/createone', array('as' => '','uses' => 'CreateCostumeController@createCostumestep1'));
Route::any('/costume/create', array('as' => '','uses' => 'CreateCostumeController@createCostumestep2'));
Route::any('/costume/createthree', array('as' => '','uses' => 'CreateCostumeController@createCostumestep3'));
Route::any('/costume/createfour', array('as' => '','uses' => 'CreateCostumeController@createCostumestep4'));
Route::any('/costume/ajaxsubcategory', array('as' => '','uses' => 'CreateCostumeController@ajaxSubCategory'));

Route::any('/costume/costumecreate', array('as' => '','uses' => 'CreateCostumeController@Costumecreate'));

/* Added by Gayatri */
Route::any('/costumedelete/{id}', 'CreateCostumeController@deleteCostume');
/* End */
/****costume create page 2 code ends here***/

/* Request a bag starts here*/
Route::any('/costume/request-a-bag', array('as' => '','uses' => 'CreateCostumeController@requestaBag'));
Route::any('/costume/postrequestabag', array('as' => '','uses' => 'CreateCostumeController@Postrequestabag'));
Route::any('/costume/successrequestbag', array('as' => '','uses' => 'CreateCostumeController@Successrequestbag'));
Route::post('/postrequestabaglogin', ['as' => 'requestabaglogin.post','uses'=>'AuthController@postrequestabagLogin']);

/* Request a bag ends here*/

/** Costume Like page start here **/
Route::any('/costume/favourite', array('as' => '','uses' => 'CostumesController@costumeFavourite'));
/** Costume Like page end here **/

Route::get('/wishlist', ['as' => 'wishlist','uses'=>'WishlistCostumesController@myWishlistList']);
Route::get('/remove/wishlist/{costume_id}', ['as' => '','uses'=>'WishlistCostumesController@removeWishlistCostume']);


Route::any('/usps', ['as' => '','uses'=>'USPSController@index']);


/**************** User Orders routes start here ******************/
Route::any('/my/orders', ['as' => 'my-orders-list','uses'=>'OrdersController@myOrdersList']);
Route::any('/my-orders-list', ['as' => '','uses'=>'OrdersController@myOrdersListData']);
Route::any('/order/{order_id}', ['as' => '','uses'=>'OrdersController@myOrderSummary']);

Route::any('/my/costumes-slod', ['as' => 'my-costumes-slod','uses'=>'OrdersController@costumeSoldList']);
Route::any('/my-costumes-slod', ['as' => '','uses'=>'OrdersController@costumeSoldListData']);
Route::any('/sold/order/{order_id}', ['as' => '','uses'=>'OrdersController@costumeSoldSummary']);
Route::any('/seller/orders/genaate-label', ['as' => '','uses'=>'OrdersController@orderLabelGenate']);
Route::any('/sold/order/track-info/download/{track_no}/{type?}', ['as' => '','uses'=>'OrdersController@downlaodTrankDetails']);
Route::any('/my-order/shipping/{order_id}', ['as' => '','uses'=>'OrdersController@orderShippingList']);
Route::any('/myorder-shippings/{order_id}', ['as' => '','uses'=>'OrdersController@orderShippingData']);
Route::any('/my-order/transactions/{order_id}', ['as' => '','uses'=>'OrdersController@orderTransactionsList']);
Route::any('/myorder-transactions/{order_id}', ['as' => '','uses'=>'OrdersController@orderTransactionsData']);
Route::any('/myorder-shippings/{order_id}', ['as' => '','uses'=>'OrdersController@orderShippingData']);

/**************** User Orders routes end here ******************/


Route::any('/getAddressInfo/{address_id}', ['as' => '','uses'=>'DashboardController@getAddressData']);

Route::any('/search/q', ['as' => '','uses'=>'SearchController@search']);
Route::any('/getSearchCostumesData', ['as' => '','uses'=>'SearchController@getSearchCostumesData']);

/************************************************** Costume URL Rewrites ******************************************************/
Route::any('/generate-url-rewrites', ['as' => 'generate-url-rewrites','uses'=>'UrlRewritesController@generateUrlRewrites']);
Route::any('/del-rewrites', ['as' => 'del-rewrites','uses'=>'UrlRewritesController@deleteUrlRewrites']);
Route::get('/getpayoutstatus', 'Admin\ReportsController@getStatusChange');
/******************************************************************************************************************************/




	Route::group(['namespace' => 'Admin', 'middleware' => 'admin',], function() {
	  	Route::get('/admin/dashboard', 'DashboardController@dashboard');
	  	Route::get('/admin/profile', 'UserController@adminProfile');
	  	Route::post('/admin/profile/post', ['as' => 'admin-profile-update','uses'=>'UserController@adminProfileUpdate']);
	  	Route::any('/settings', ['as' => 'settings','uses'=>'UserController@adminSettings']);
	  	Route::post('/request_bag/settings', ['as' => 'request_bag','uses'=>'UserController@requesBagSettings']);
	  	Route::post('/search_banner/settings', ['as' => 'search_banner','uses'=>'UserController@searchBannerSettings']);
	   /****************User Management Start Here***************************/
	    Route::get('customers-list', ['as' => 'customers-list','uses'=>'UserController@customersList']);
		Route::get('customes-list', ['as' => 'customes-list','uses'=>'UserController@customesList']);
	    Route::any('/customers/list', 'UserController@customersListData');
	    Route::any('customers-search', 'UserController@searchCustomers');
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
	    Route::post('user/csvExport', array('as' => '','uses' => 'UserController@userCsvExport'));
	   	Route::any('user/getallpaymentprofile', array('as' => '','uses' => 'UserController@Getallpaymentprofile'));
	   	Route::any('user/deleteccard/{id}', ['as' => '','uses'=>'UserController@Deleteccard']);
	   	Route::any('user/getallusercostumes', array('as' => '','uses' => 'UserController@Getallusercostumes'));

		Route::any('/user-orders-list/{user_id}', ['as' => '','uses'=>'UserController@userOrdersListData']);
		Route::any('/user-costumes-slod/{user_id}', ['as' => '','uses'=>'UserController@userCostumeSoldListData']);
	   	/****************User Management End Here***************************/

		/****************Costumes Management Code Starts Here*********************/
		
		Route::any('/costumes/create', ['as' => 'costumes-create','uses'=>'CostumeController@createCostume']);
		Route::post('/upload', ['as' => 'image.store' , 'uses' => 'CostumeController@post_upload']);
		Route::get('costumes-list', ['as' => 'costumes-list','uses'=>'CostumeController@costumesList']);
		Route::any('costumes-insert', ['as' => 'costumes-insert','uses'=>'CostumeController@insertCostume']);
		Route::get('/reported/costumes', ['as' => 'reported-costumes-list','uses'=>'CostumeController@getReportedCostumes']);
		Route::any('/costume-reports-list', ['as' => '','uses'=>'CostumeController@getReportedCostumesData']);
	   	Route::get('/getallcostumes', array('as' => '','uses' => 'CostumeController@Getallcostumes'));
	   	Route::post('/getallsearchcostumes', array('as' => '','uses' => 'CostumeController@Getallsearchcostumes'));
	   	Route::get('/custome-listing/{id}', ['as' => '','uses'=>'CostumeController@CostumeList']);
	   	Route::any('/changecostumestatus', ['as' => '','uses'=>'CostumeController@changeCostumeStatus']);
	   	Route::any('/deletecostume/{id}', ['as' => '','uses'=>'CostumeController@deleteCostume']);
	   	Route::any('/updatecostume', ['as' => 'update-costume','uses'=>'CostumeController@updateCostume']);
	   	Route::any('/changefeaturestatus', ['as' => '','uses'=>'CostumeController@changeFeaturedStatus']);
	   	Route::any('/delete-costume-image', ['as' => 'delete-costume-image','uses'=>'CostumeController@deleteCostumeImage']);
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
		Route::any('/categories/create', ['as' => 'categories-create','uses'=>'CategoriesController@createCategories']);
	    Route::any('/categories/edit/{id?}', ['as' => 'categories-edit','uses'=>'CategoriesController@editCategories']);
	    Route::any('/category-delete/{id}', ['as' => '','uses'=>'CategoriesController@deleteCategory']);
	    Route::any('/categories', ['as' => 'categories-list','uses'=>'CategoriesController@categoriesList']);
	    Route::any('/categories-list', ['as' => '','uses'=>'CategoriesController@categoriesData']);
	    Route::any('/getCostumesList', ['as' => '','uses'=>'CategoriesController@getCostumesList']);
	    Route::get('/delete/categorycostume/{pid}/{cid}', 'CategoriesController@deleteCategoryCostume');
	    //Route::get('/abc', 'CategoriesController@deleteCategoryCostume');
	    
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
	    Route::post('/charities/csvExport', array('as' => '','uses' => 'CharitiesController@charitiesCsvExport'));
	   /****************Charities Management Ends Here***********************/

	   /*****************************Orders starts here ***********************/
	    Route::any('/orders', ['as' => 'orders-list','uses'=>'OrdersController@ordersList']);
	    Route::any('/orders-list', ['as' => '','uses'=>'OrdersController@ordersListData']);
	    Route::any('/order/summary/{order_id}', ['as' => '','uses'=>'OrdersController@orderSummary']);
	    Route::any('/order/desputes/{order_id}', ['as' => '','uses'=>'OrdersController@orderDesputes']);
	    Route::post('order/status/update', ['as' => '','uses'=>'OrdersController@orderStatusUpdate']);
	    Route::post('/add/order/transation', ['as' => '','uses'=>'OrdersController@orderAdditionalTransaction']);
	    Route::post('/order/billing-address/update', ['as' => '','uses'=>'OrdersController@OrderBillingAddressUpate']);
	    Route::post('/order/shipping-address/update', ['as' => '','uses'=>'OrdersController@OrderShippingAddressUpate']);
	    Route::post('/orders/genaate-label', ['as' => '','uses'=>'OrdersController@orderLabelGenate']);
	    Route::any('/order/track-info/download/{track_no}/{type}', ['as' => '','uses'=>'OrdersController@downlaodTrankDetails']);
	    Route::any('/order/shipping/{order_id}', ['as' => '','uses'=>'OrdersController@orderShippingList']);
	    Route::any('/order-shippings/{order_id}', ['as' => '','uses'=>'OrdersController@orderShippingData']);
	    Route::any('/order/transactions/{order_id}', ['as' => '','uses'=>'OrdersController@orderTransactionsList']);
	    Route::any('/order-transactions/{order_id}', ['as' => '','uses'=>'OrdersController@orderTransactionsData']);
	    Route::any('/export-orders', ['as' => '','uses'=>'OrdersController@ordersCsvExport']);

	     /*****************************Orders ends here ***********************/

	    /*****************************Transactions starts here ***********************/
	    Route::any('/transactions', ['as' => 'transactions-list','uses'=>'TransactionsController@transactionsList']);
	    Route::any('/transactions-list', ['as' => '','uses'=>'TransactionsController@transactionsListData']);
	    Route::any('/transaction/summary/{transaction_id}', ['as' => '','uses'=>'TransactionsController@transactionView']);
	    Route::any('/export-transaction', ['as' => '','uses'=>'TransactionsController@transactionsCsvExport']);

	    /*****************************Transactions end here ***********************/

	   	Route::any('/manage-bags', ['as' => 'manage-bags','uses'=>'RequestabagController@manageBag']);
	   	Route::any('/process-bag/{id}', ['as' => '','uses'=>'RequestabagController@processBag']);
	   	Route::get('/getallmanagebags', array('as' => '','uses' => 'RequestabagController@Getallmanagebags'));
	   	Route::any('/generatelables', array('as' => '','uses' => 'RequestabagController@Generatelables'));
	   	Route::any('/returnlablegenerate', array('as' => '','uses' => 'RequestabagController@returnLableGenerate'));
	   	Route::any('/payoutamount', array('as' => '','uses' => 'RequestabagController@Payoutamount'));
	   	Route::any('/returnamount', array('as' => '','uses' => 'RequestabagController@Returnamount'));
	   	Route::any('/closerequest', array('as' => '','uses' => 'RequestabagController@Closerequest'));
	   	Route::any('/requestabag_message',array('as' => '','uses' => 'RequestabagController@RequestabagMessage'));
	   	Route::any('/request-bag/label/{track_id}',array('as' => '','uses' => 'RequestabagController@downlaodRequestBagLabels'));
	   /*****************************Request a bag ends here ***********************/
	   /****************Events Management Starts Here*********************/
	   
	   
	   Route::any('/events-list', [
	   		'as' => 'events-list',
	   		'uses' => 'EventController@eventsList'
	   	]);
	   Route::any('/add-event', [
	   		'as' => 'add-event',
	   		'uses' => 'EventController@addEvent'
	   	]);
	   Route::any('events-fetch', [
	   		'as' => 'events-fetch',
	   		'uses' => 'EventController@EventsFetch'
	   	]);
	   Route::post('/insertevents', [
	   		'as' => 'insert-events',
	   		'uses' => 'EventController@insertEvents'
	   	]);
	   Route::any('/admin/editevent/{id}', [
	   		'as' => 'editevent',
	   		'uses' => 'EventController@editEvent'
	   	]);
	   Route::any('/admin/updateevent', [
	   		'as' => '',
	   		'uses' => 'EventController@updateEvent'
	   	]);
	   Route::any('/admin/deleteevent/{id}', [
	   		'as' => '',
	   		'uses' => 'EventController@deleteEvent'
	   	]);
	   Route::any('/admin/event/search', [
			'as' => '',
	   		'uses' => 'EventController@searchEvent'
		]);

	   

	   Route::any('/admin/event/tags', [
	   		'as' => '',
	   		'uses' => 'EventController@tagsEvents'
	   	]);
	   Route::any('/admin/changeapprovedstatus', [
	   		'as' => 'admin/changeapprovedstatus',
	   		'uses' => 'EventController@updateeventStatus'
	   	]);
	   Route::any('/admin/events/status', ['uses' => 'EventController@industryStatus'
	   	]);



/****************Events Management Ends Here***********************/

/****************Press Management Starts Here*********************/

Route::any('/press-posts', [
	   		'as' => 'press-posts',
	   		'uses' => 'PressController@pressPosts'
	   	]);
Route::any('/press-post-list', [
			'as' => 'press-post-list',
	   		'uses' => 'PressController@pressPostList'
	]);

Route::any('/add-press-post', [
	   		'as' => 'add-press-post',
	   		'uses' => 'PressController@addPressPost'
	   	]);
Route::any('/insert-press-post', [
			'as' => 'insert-press-post',
	   		'uses' => 'PressController@insertPressPost'
	]);
Route::any('/admin/editpress/{id}', [
			'as' => 'admin/editpress',
	   		'uses' => 'PressController@editPressPost'
	]);
Route::any('/admin/updatepress', [
			'as' => 'admin/updatepress',
	   		'uses' => 'PressController@updatePressPost'
	]);
Route::any('/admin/deletepress/{id}', [
			'as' => 'admin/deletepress',
	   		'uses' => 'PressController@deletePressPost'
	]);
Route::any('/admin/press/search', [
			'as' => '',
	   		'uses' => 'PressController@searchPress'
	]);
Route::any('/admin/changepublishstatus', [
			'as' => 'admin/changepublishstatus',
	   		'uses' => 'PressController@searchPress'
	]);
Route::any('/admin/press/status', 'PressController@industryStatus');


/****************Press Management Ends Here***********************/

/****************Support Management Starts Here*********************/

Route::any('support-tickets', [
	   		'as' => 'support-tickets',
	   		'uses' => 'SupportController@supportTickets'
	   	]);



Route::any('manage-ticket', [
	   		'as' => 'manage-ticket',
	   		'uses' => 'SupportController@manageTicket'
	   	]);


/****************Support Management Ends Here***********************/

/****************Blog Management Starts Here*********************/
Route::any('blog-posts', [
            'as' => 'blog-posts',
               'uses' => 'BlogController@index'
    ]);
Route::get('get-all-blog-posts', [
   'as' => 'get-all-blog-posts',
   'uses' => 'BlogController@getAllPosts'
]);
Route::any('add-blog-post', [
            'as' => 'add-blog-post',
               'uses' => 'BlogController@addBlogPost'
    ]);
Route::any('edit-blog-post/{id}', [
   'as' => 'edit-blog-post',
   'uses' => 'BlogController@edit'
]);
Route::any('update-blog-post/{id}', [
   'as' => 'update-blog-post',
   'uses' => 'BlogController@update'
]);
Route::any('add-blog-category', [
   'as' => 'add-blog-category',
   'uses' => 'BlogController@addBlogCategory'
]);
Route::any('edit-blog-category', [
    'as' => 'edit-blog-category',
    'uses' => 'BlogController@editBlogCategory'
]);
Route::any('blog-category-availability', [
   'as' => 'blog-category-availability',
   'uses' => 'BlogController@checkBlogCategory'
]);
Route::any('delete-blog-category/{id}', [
    'as' => 'delete-blog-category',
    'uses' => 'BlogController@deleteBlogCategory'
]);
Route::any('store-blog-post', [
   'as' => 'store-blog-post',
   'uses' => 'BlogController@store'
]);
Route::any('delete-blog-post/{id}', [
   'as' => 'delete-blog-post',
   'uses' => 'BlogController@destroy'
]);
Route::any('blog-post-search', [
    'as' => 'blog-post-search',
    'uses' => 'BlogController@blogPostSearch'
]);
Route::any('change-blog-status', [
    'as' => 'change-blog-status',
    'uses' => 'BlogController@changeBlogStatus'
]);

/****************Blog Management Ends Here***********************/

/**************** CMS Pages Starts Here*********************/
        Route::any('add-cms-page', [
                'as' => 'add-cms-page',
                'uses' => 'CmsController@addCmsPage'
            ]);
        Route::any('cms-pages', [
                'as' => 'cms-pages',
                'uses' => 'CmsController@cmsPages'
            ]);
        Route::post('store-cms-page', [
            'as' => 'store-cms-page',
            'uses' => 'CmsController@store'
        ]);
        Route::get('get-all-pages', [
            'as' => 'get-all-pages',
            'uses' => 'CmsController@getAllPages'
        ]);

        Route::any('delete-page/{id}', [
            'as' => 'delete-page',
            'uses' => 'CmsController@destroy'
        ]);

        Route::any('edit-page/{id}', [
            'as' => 'edit-page',
            'uses' => 'CmsController@edit'
        ]);

        Route::any('update-page/{id}', [
            'as' => 'update-page',
            'uses' => 'CmsController@update'
        ]);

        Route::any('change-page-status', [
            'as' => 'change-page-status',
            'uses' => 'CmsController@changePageStatus'
        ]);

        Route::any('page-search', [
            'as' => 'page-search',
            'uses' => 'CmsController@pageSearch'
        ]);
        Route::any('check-url-availability', [
            'as' => 'check-url-availability',
            'uses' => 'CmsController@checkUrlAvailability'
        ]);

        /******************** End CMS Pages Routes ***************/

        /******************** CMS blocks routes ******************/

        Route::any('cms-blocks', [
            'as' => 'cms-blocks',
            'uses' => 'CmsController@cmsBlocks'
        ]);
        Route::any('add-cms-block', [
            'as' => 'add-cms-block',
            'uses' => 'CmsController@addCmsBlock'
        ]);
        Route::get('get-all-blocks', [
            'as' => 'get-all-blocks',
            'uses' => 'CmsController@getAllBlocks'
        ]);
        Route::post('store-cms-block', [
            'as' => 'store-cms-block',
            'uses' => 'CmsController@storeCmsBlock'
        ]);
        Route::any('edit-block/{id}', [
            'as' => 'edit-block',
            'uses' => 'CmsController@editBlock'
        ]);
        Route::any('update-block/{id}', [
            'as' => 'update-block',
            'uses' => 'CmsController@updateCmsBlock'
        ]);
        Route::any('delete-block/{id}', [
            'as' => 'delete-block',
            'uses' => 'CmsController@destroyBlock'
        ]);
        Route::any('change-block-status', [
            'as' => 'change-block-status',
            'uses' => 'CmsController@changeBlockStatus'
        ]);
        Route::any('block-search', [
            'as' => 'block-search',
            'uses' => 'CmsController@blockSearch'
        ]);
       /***************** End CMS Blocks Routes ******************/

/****************Jobs Management Starts Here*********************/
Route::any('manage-jobs', [
		'as' => 'manage-jobs',
	   	'uses' => 'JobsController@manageJobs'
	]);
Route::any('add-job-post', [
		'as' => 'add-job-post',
	   	'uses' => 'JobsController@addJobPost'
	]);
 
/****************Jobs Management Ends Here***********************/

/************************* FAQ routes starts here ***************************/
Route::any('manage-faqs', [
    'as' => 'manage-faqs',
    'uses' => 'FaqController@index'
]);
Route::any('add-faqs', [
    'as' => 'add-faqs',
    'uses' => 'FaqController@addFaqs'
]);
Route::any('get-all-faqs', [
    'as' => 'get-all-faqs',
    'uses' => 'FaqController@getAllFaqs'
]);
Route::any('store-faq', [
    'as' => 'store-faq',
    'uses' => 'FaqController@store'
]);
Route::any('edit-faq/{id}', [
    'as' => '',
    'uses' => 'FaqController@edit'
]);
Route::any('update-faq/{id}', [
    'as' => '',
    'uses' => 'FaqController@update'
]);
Route::any('delete-faq/{id}', [
    'as' => '',
    'uses' => 'FaqController@delete'
]);
Route::any('faq-search', [
    'as' => 'faq-search',
    'uses' => 'FaqController@faqSearch'
]);
        Route::any('change-faq-status', [
            'as' => 'change-faq-status',
            'uses' => 'FaqController@changeFaqSatus'
        ]);
/************************* End FAQ routes here ***************************/

});
/****************Messaging Starts Here*********************/

Route::any('message/{id}', 'MessageController@chatHistory')->name('message.read');
Route::get('conversations', 'MessageController@converstationsofUser');
Route::post('conversation/delete', 'MessageController@converstationsDelete');

Route::group(['prefix'=>'ajax', 'as'=>'ajax::'], function() {
   Route::post('message/send', 'MessageController@ajaxSendMessage')->name('message.new');
   Route::delete('message/delete/{id}', 'MessageController@ajaxDeleteMessage')->name('message.delete');
});
/****************Messaging Ends Here***********************/
/****************Ticket Routes Code Starts Here**************/
Route::any('contact-support', [
		'as' => 'contact-support',
	   	'uses' => 'TicketController@supportContact'
	]);
Route::post('insert-support', [
		'as' => 'insert-support',
	   	'uses' => 'TicketController@supportInsert'
	]);
Route::post('update-ticket-support', [
		'as' => 'update-ticket-support',
	   	'uses' => 'Admin\TicketController@updateSupport'
	]);
/****************Ticket Routes code ends here*******************/
/***************Ticket Admin routes code starts here*************/
Route::any('tickets-list', [
		'as' => 'tickets-list',
	   	'uses' => 'Admin\TicketController@ticketsList'
	]);
Route::any('support-users', [
		'as' => 'support-users',
	   	'uses' => 'Admin\TicketController@supportUsers'
	]);
Route::get('getallsupportusers', [
		'as' => 'getallsupportusers',
	   	'uses' => 'Admin\TicketController@getSupportUsers'
	]);
Route::any('manage-tickets/{id}', [
		'as' => 'manage-tickets',
	   	'uses' => 'Admin\TicketController@manageTickets'
	]);
Route::any('/deleteticket/{id}', ['as' => '','uses'=>'Admin\TicketController@deleteTicket']);
Route::any('/changeticketstatus', ['as' => '','uses'=>'Admin\TicketController@changeTicketstatus']);
Route::get('/getalltickets', array('as' => '','uses' => 'Admin\TicketController@getallTickets'));

Route::any('/support_message',array('as' => 'support_message','uses' => 'Admin\TicketController@insertSupportMessage'));
Route::any('/update_suport_status',array('as' => 'update_suport_status','uses' => 'Admin\TicketController@updateSupportMessage'));


	   


/***************Ticket Admin routes code ends here*************/


/*************** press routes starts here **********************/

Route::any('/press', [
    'as' => 'press',
    'uses' => 'PressController@index'
]);

/**************** events route starts here *******************/

Route::any('/events', [
    'as' => 'events',
    'uses' => 'EventsController@index'
]);

Route::any('/save-event/{id}', [
    'as' => 'save-event',
    'uses' => 'EventsController@store'
]);
Route::any('/search', [
    'as' => 'search',
    'uses' => 'EventsController@searchByZip'
]);
/****************** events routes ends here **********************/
Route::any('/costume/edit/{id}', array('as' => '','uses' => 'CreateCostumeController@EditCostume'));
/* Code added by Gayatri */
Route::any('/costume/edit/{id}/charity', array('as' => '','uses' => 'CreateCostumeController@EditCostume'));
/* End */
Route::any('costume/costumeeditadd', array('as' => '','uses' => 'CreateCostumeController@EditCostumeAdd'));
Route::any('/my/costumes', array('as' => '','uses' => 'CreateCostumeController@MyCostumes'));
Route::any('/my-costumes-list', ['as' => '','uses'=>'OrdersController@myCostumesListData']);
Route::any('support/search', ['as' => '','uses' => 'Admin\TicketController@searchTickets']);
  Route::get('ckeditor1',function(){
       return view('ckeditor.index');
});



/************************ cms user side routes ******************/
Route::get('/pages/about-us', [
    'as' => 'about-us',
    'uses' => 'CmsController@viewAboutUs'
]);
Route::get('/pages/how-it-works', [
    'as' => 'how-it-works',
    'uses' => 'CmsController@viewHowItWorks'
]);
Route::get('/pages/terms-of-use', [
    'as' => 'terms-of-use',
    'uses' => 'CmsController@viewTermsOfUse'
]);
Route::get('/pages/privacy-policy', [
    'as' => 'privacy-policy',
    'uses' => 'CmsController@viewPrivacyPolicy'
]);
Route::get('/pages/our-motto', [
    'as' => 'our-motto',
    'uses' => 'CmsController@viewOurMotto'
]);
Route::get('/pages/view-jobs', [
    'as' => 'view-jobs',
    'uses' => 'CmsController@viewJobs'
]);
Route::get('/giving-back', [
    'as' => 'giving-back',
    'uses' => 'CmsController@viewGivingBack'
]);
/*******Specia;lty them code starts here*****/
 Route::any('specality-themes', [
	   		'as' => 'specality-themes',
	   		'uses' => 'SpecialityThemeController@specialityTheme'
	   	]);
 /******Admin Speciality theme code starts here***/
 Route::any('specality-themes-priority', [
	   		'as' => 'specality-themes-priority',
	   		'uses' => 'Admin\SpecailityThemeController@themePriority'
	   	]);
 Route::any('check_priority', [
	   		'as' => 'check_priority',
	   		'uses' => 'Admin\SpecailityThemeController@checkPriority'
	   	]);
Route::any('update_priority',array('as' => 'update_priority','uses' => 'Admin\SpecailityThemeController@updatePriority'));
/************Jobs code starts  Admin here***/
Route::any('jobs-list', [
		'as' => 'jobs-list',
	   	'uses' => 'Admin\JobController@jobsList'
	]);
Route::any('create-job', [
		'as' => 'create-job',
	   	'uses' => 'Admin\JobController@createJob'
	]);
Route::post('insert-jobs', [
		'as' => 'insert-jobs',
	   	'uses' => 'Admin\JobController@insertJob'
	]);
Route::post('update-jobs', [
		'as' => 'update-jobs',
	   	'uses' => 'Admin\JobController@updateJob'
	]);
Route::get('getalljobs', [
		'as' => 'getalljobs',
	   	'uses' => 'Admin\JobController@getJobs'
	]);
Route::any('/jobs_list/edit/{id}', array('as' => '','uses' => 'Admin\JobController@editJobs'));
/********Jobs front routes code starts here****/
Route::any('jobs', [
		'as' => 'jobs',
	   	'uses' => 'JobController@jobsList'
	]);

Route::any('contactchrysalis', [
		'as' => 'contactchrysalis',
	   	'uses' => 'JobController@contactChrysalis'
	]);


/*************************** User Blog Routes ****************************/
Route::any('blog', [
    'as' => 'blog',
    'uses' => 'BlogController@index'
]);
Route::any('blog/{id}', [
    'as' => '',
    'uses' => 'BlogController@show'
]);
Route::any('save-blog-post', [
    'as' => 'save-blog-post',
    'uses' => 'BlogController@store'
]);
Route::any('/blog/category/{id}/{category}', [
    'as' => '',
    'uses' => 'BlogController@viewPostByCategory'
]);
    Route::any('blog/tag/{tag}', [
    'as' => '',
    'uses' => 'BlogController@viewPostByTag'
]);

    Route::any('/admin/jobs/search', [
			'as' => '',
	   		'uses' => 'Admin\JobController@searchJObs'
	]);
Route::any('/admin/job/status', 'Admin\JobController@jobStatus');
Route::any('/admin/deletejob/{id}', ['as' => '','uses'=>'Admin\JobController@deleteJob']);

Route::any('blog/archive/{years}', [
    'as' => '',
    'uses' => 'BlogController@viewPostByYears'
]);
//Routes regarding reports code starts here
Route::any('revenue-reports', [
    'as' => 'revenue-reports',
    'uses' => 'Admin\ReportsController@revenueReports'
]);
Route::any('getrevenues', [
    'as' => 'getrevenues',
    'uses' => 'Admin\ReportsController@getallRevenues'
]);
Route::any('search-revenue', [
    'as' => 'search-revenue',
    'uses' => 'Admin\ReportsController@searchRevenue'
]);
Route::any('seller-report', [
    'as' => 'seller-report',
    'uses' => 'Admin\ReportsController@sellerReport'
]);
Route::any('get-all-sales', [
    'as' => 'get-all-sales',
    'uses' => 'Admin\ReportsController@getAllSales'
]);
Route::any('search-sellers', [
    'as' => 'search-sellers',
    'uses' => 'Admin\ReportsController@searchSellers'
]);
Route::any('event-report', [
    'as' => 'event-report',
    'uses' => 'Admin\ReportsController@eventReport'
]);
Route::any('get-all-events', [
    'as' => 'get-all-events',
    'uses' => 'Admin\ReportsController@getAllEvents'
]);
Route::any('search-events', [
    'as' => 'search-events',
    'uses' => 'Admin\ReportsController@searchEvents'
]);
Route::any('blog-report', [
    'as' => 'blog-report',
    'uses' => 'Admin\ReportsController@blogReport'
]);
Route::any('get-all-blog', [
    'as' => 'get-all-blog',
    'uses' => 'Admin\ReportsController@getAllBlog'
]);
Route::any('search-blog', [
    'as' => 'search-blog',
    'uses' => 'Admin\ReportsController@searchBlog'
]);
Route::any('product-report', [
    'as' => 'product-report',
    'uses' => 'Admin\ReportsController@productReport'
]);
Route::any('get-all-products', [
    'as' => 'get-all-products',
    'uses' => 'Admin\ReportsController@getAllProducts'
]);
Route::any('search-products', [
    'as' => 'search-products',
    'uses' => 'Admin\ReportsController@searchProducts'
]);
Route::any('users-report', [
    'as' => 'users-report',
    'uses' => 'Admin\ReportsController@userReport'
]);
Route::any('get-all-users', [
    'as' => 'get-all-users',
    'uses' => 'Admin\ReportsController@getAllUsers'
]);
Route::any('search-users', [
    'as' => 'search-users',
    'uses' => 'Admin\ReportsController@searchUsers'
]);
Route::any('profile-report', [
    'as' => 'profile-report',
    'uses' => 'Admin\ReportsController@profileReport'
]);
Route::any('get-all-profiles', [
    'as' => 'get-all-profiles',
    'uses' => 'Admin\ReportsController@getAllProfiles'
]);
Route::any('search-profiles', [
    'as' => 'search-profiles',
    'uses' => 'Admin\ReportsController@searchProfiles'
]);
Route::any('cost-report', [
    'as' => 'cost-report',
    'uses' => 'Admin\ReportsController@costReport'
]);
Route::any('get-all-costs', [
    'as' => 'get-all-costs',
    'uses' => 'Admin\ReportsController@getAllCosts'
]);
Route::any('search-costs', [
    'as' => 'search-costs',
    'uses' => 'Admin\ReportsController@searchCosts'
]);
Route::any('request-bag-report', [
    'as' => 'request-bag-report',
    'uses' => 'Admin\ReportsController@requestBagReport'
]);
Route::any('get-all-request-bags', [
    'as' => 'get-all-request-bags',
    'uses' => 'Admin\ReportsController@getAllRequestBags'
]);
Route::any('search-request-bags', [
    'as' => 'search-request-bags',
    'uses' => 'Admin\ReportsController@searchRequestBags'
]);
Route::any('charity-report', [
    'as' => 'charity-report',
    'uses' => 'Admin\ReportsController@charityReport'
]);
Route::any('get-all-charities', [
    'as' => 'get-all-charities',
    'uses' => 'Admin\ReportsController@getAllCharities'
]);
Route::any('search-charities', [
    'as' => 'search-charities',
    'uses' => 'Admin\ReportsController@searchCharities'
]);
Route::any('discounts-report', [
    'as' => 'discounts-report',
    'uses' => 'Admin\ReportsController@discountsReport'
]);
Route::any('get-all-discounts', [
    'as' => 'get-all-discounts',
    'uses' => 'Admin\ReportsController@getAllDiscounts'
]);
Route::any('search-discounts', [
    'as' => 'search-discounts',
    'uses' => 'Admin\ReportsController@searchDiscounts'
]);
Route::any('paypal-reports', [
    'as' => 'paypal-reports',
    'uses' => 'Admin\ReportsController@paypalReports'
]);
Route::any('getpaypal', [
    'as' => 'getpaypal',
    'uses' => 'Admin\ReportsController@getallPaypal'
]);
Route::post('/admin/paypal/search', [
    'as' => '',
    'uses' => 'Admin\ReportsController@getsearchPaypal'
]);
Route::post('/admin/paypal/batchpayout', [
    'as' => 'batchpayout',
    'uses' => 'Admin\ReportsController@BatchPayouts'
]);


/*************************** End User Blog Routes ****************************/
/*****Mail chimp code starts here***/
Route::post('subscribenews',['as'=>'subscribenews','uses'=>'MailChimpController@subscribe']);
/*****Mail chimp code ends here***/

Route::any('getpaypal', [
    'as' => 'getpaypal',
    'uses' => 'Admin\ReportsController@getallPaypal'
]);

Route::get('500', function()
{
    abort(404);
});

Route::any('/testData','CostumesController@test');

