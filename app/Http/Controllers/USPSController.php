<?php

namespace App\Http\Controllers;
use app\Http\Requests;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use PayPal\Api\Payout;
use PayPal\Auth\OAuthTokenCredential;



class USPSController extends Controller
{

 public function index() {
 	// Create a new instance of Payout object
    $payouts = new Payout();

        $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();

        $apiContext = new ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                "AS7XsXhGolix8b2nS5Qc_C5s8MX6ERDfkPxysyxtrFoMGmHuCo06KAXi2fiWcESUMqc3a3haQgiaEuEK",
                "ECjXalkL4YMAYJLcoSQrSRwd21EojUfgH2Jw7AA8gFq-2KTjVnTH4ig7mHUAGTq4iV5zxMmJzHfvXKpJ"
            )
        );
$senderBatchHeader->setSenderBatchId(uniqid())
    ->setEmailSubject("You have a payment");
// #### Sender Item
// Please note that if you are using single payout with sync mode, you can only pass one Item in the request
$senderItem1 = new \PayPal\Api\PayoutItem();
$senderItem1->setRecipientType('Email')
    ->setNote('Thanks you.')
    ->setReceiver('vamsi@dotcomweavers.com')
    ->setSenderItemId("item_1" . uniqid())
    ->setAmount(new \PayPal\Api\Currency('{
                        "value":"0.02",
                        "currency":"USD"
                    }'));
// #### Sender Item 2
// There are many different ways of assigning values in PayPal SDK. Here is another way where you could directly inject json string.

$payouts->setSenderBatchHeader($senderBatchHeader)
    ->addItem($senderItem1);
// For Sample Purposes Only.
$request = clone $payouts;
// ### Create Payout
try {
    $output = $payouts->create(null, $apiContext);
//echo "<pre>";print_r($output);
} catch (Exception $ex) {
   dd($ex);
}
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
echo "test";
return $output;
 }
}