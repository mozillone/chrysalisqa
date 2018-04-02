<?php
return array(
    'Amenties_id' => '1',
	'Style_id' => '2',
    'IMAGES_PATH'=>'',
    'FROM_EMAIL'=>'jithender@dotcomweavers.com',
	'FAQ_ID'=>8,
	'FAQ_OPTION_VALUE'=>0,
	'IS_FILMY'=>21,
	'IS_Returns'=>15,
	'Shipping_id'=>9,
	'Processing'=>1,
	'Shipping'=>2,
	'Currency'=>'usd',

	'USPS'=>'518CHRYS8010',
	'USPS_Password'=>'232IM84WE648',
	'USPS_RATE_URL'=>'http://production.shippingapis.com/ShippingAPI.dll?API=RateV4',
	'USPS_SHIPPING_URL'=>'https://secure.shippingapis.com/ShippingAPI.dll?API=DeliveryConfirmationV4',

	

	/* testing 
	'FedEx_Ship_Url'=>'https://wsbeta.fedex.com:443/web-services/ship',
	'FedEx_Key'=>'pWPjhX3ehXQYuCjO',
	'FedEx_Password'=>'lhkPEqBBz6zU2UV99bnJhbILX',
	'FedEx_AccountNumber'=>'510087100',
	'FedEx_MeterNumber'=>'118828727',
	

	'FedEx_Key'=>'Ok50l4xFxVVHosR2',
	'FedEx_Password'=>'vXRQpnIFtzW3okIComTl77rHO',
	'FedEx_AccountNumber'=>'510087640',
	'FedEx_MeterNumber'=>'100342598',
	*/

	/* testing */
	'FedEx_Ship_Url'=>env('FEDEX_SHIP_URL'),
	'FedEx_Key'=>env('FEDEX_KEY'),
	'FedEx_Password'=>env('FEDEX_PASSWORD'),
	'FedEx_AccountNumber'=>env('FEDEX_ACCOUNT_NUMBER'),
	'FedEx_MeterNumber'=>env('FEDEX_METER_NUMBER'),


	
	/* live */

	/*'FedEx_Ship_Url'=>' https://ws.fedex.com:443/web-services',
	'FedEx_Key'=>'dnIjZmbyft2X8rmy',
	'FedEx_Password'=>'0YeL33GGAqWhfZsG3c4nDFE49',
	'FedEx_AccountNumber'=>'873082887',
	'FedEx_MeterNumber'=>'111338298',
	*/
	'FedEx_SmartPostKey'=>env('FEDEX_SMARTPOST_KEY'),
	'FedEx_SmartPostPassword'=>env('FEDEX_SMARTPOST_PASSWORD'),
	'FedEx_SmartPostAccountNumber'=>env('FEDEX_SMARTPOST_ACCOUNT_NUMBER'),
	'FedEx_SmartPostMeterNumber'=>env('FEDEX_SMARTPOST_METER_NUMBER'),
	'FedEx_SmartPostHubId'=>env('FEDEX_SMARTPOST_HUBID'),

    'ENDICIA_REQUESTERID'=>env('ENDICIA_REQUESTER_ID'),
    'ENDICIA_ACCOUNTID'=>env('ENDICIA_ACCOUNT_ID'),
    'ENDICIA_PASSPHRASE'=>env('ENDICIA_PASS_PHRASE'),
    'ENDICIA_APIENDPOINT'=>env('ENDICIA_API_ENDPOINT'),
    
    'PAYPAL_USERVERIFY_URL'=>env('PAYPAL_USER_VERIFY_URL'),
    'PAYPAL_APIUSERNAME'=>env('PAYPAL_API_USERNAME'),
    'PAYPAL_APIPASSWORD'=>env('PAYPAL_API_PASSWORD'),
    'PAYPAL_APISIGNATURE'=>env('PAYPAL_API_SIGNATURE'),
    'PAYPAL_OAUTHTOKEN'=>env('PAYPAL_OAUTH_TOKEN'),
    'PAYPAL_OAUTHSECRET'=>env('PAYPAL_OAUTH_SECRET'),

    'INSTAGRAM_ACCESS_TOKEN'=>env('INSTAGRAM_ACCESS_TOKEN'),
	'INSTAGRAM_USERNAME'=>env('INSTAGRAM_USERNAME')
);