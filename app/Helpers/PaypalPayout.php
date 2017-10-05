<?php

namespace App\Helpers;
use app\Http\Requests;

use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use PayPal\Api\Payout;
use PayPal\Auth\OAuthTokenCredential;
use Config;


class PayPalPayout 
{

 public static function SinglePayout($email,$amount) {
    $message = '';
    $api_request = array('email' => $email, 'amount' =>$amount);
 	// Create a new instance of Payout object
    $payouts = new Payout();

        $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();

        $apiContext = new ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                Config::get('constants.PAYPAL_OAUTHTOKEN'),
                Config::get('constants.PAYPAL_OAUTHSECRET')
            )
        );
$senderBatchHeader->setSenderBatchId(uniqid())
    ->setEmailSubject("You have a payment");
// #### Sender Item
// Please note that if you are using single payout with sync mode, you can only pass one Item in the request
$senderItem1 = new \PayPal\Api\PayoutItem();
$senderItem1->setRecipientType('Email')
    ->setNote('Thanks you.')
    ->setReceiver($email)
    ->setSenderItemId("item_1" . uniqid())
    ->setAmount(new \PayPal\Api\Currency('{
                        "value":"'.$amount.'",
                        "currency":"USD"
                    }'));
// #### Sender Item 2
// There are many different ways of assigning values in PayPal SDK. Here is another way where you could directly inject json string.

$payouts->setSenderBatchHeader($senderBatchHeader)
    ->addItem($senderItem1);
// For Sample Purposes Only.
$request = clone $payouts;
// ### Create Payout
if($message == '') {
      $message = 'Message is empty';
    }
 
   // Get IP address
    if( ($remote_addr = \Request::ip()) == '') {
        $remote_addr = 'REMOTE_ADDR_UNKNOWN';
    }
 
   // Get requested script
    if( ($request_uri = \Request::path()) == '') {
        $request_uri = 'REQUEST_URI_UNKNOWN';
    }
    $api_data = array(
               'api_type'       => 'PayPal',
               'remote_addr'    => $remote_addr,
               'request_uri'    => $request_uri,
               'api_request'    => json_encode($api_request),
               'message'        => $message,
               'log_date'       => date('Y-m-d H:i:s')
           );
try {
    $output = $payouts->create(null, $apiContext);
    $api_data['api_response'] = "batch_status=".$output->batch_header->batch_status.", link=".$output->links[0]->href;
} catch (\PayPal\Exception\PayPalConnectionException $ex) {
        $api_data['api_response'] = json_encode($ex->getData());    
    }catch (\Exception $ex) {
       $api_data['api_response'] = $ex->getMessage();
    }
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//echo $output;die;
$insertin_log = Site_model::insert_get_id('api_log',$api_data);
return $output;
 }


 public static function getPayoutStatus($payoutBatchId)
    {
        $message = '';
        $api_request = $payoutBatchId;
        if($message == '') {
          $message = 'Message is empty';
        }
     
       // Get IP address
        if( ($remote_addr = \Request::ip()) == '') {
            $remote_addr = 'REMOTE_ADDR_UNKNOWN';
        }
     
       // Get requested script
        if( ($request_uri = \Request::path()) == '') {
            $request_uri = 'REQUEST_URI_UNKNOWN';
        }
        $api_data = array(
                   'api_type'       => 'PayPal',
                   'remote_addr'    => $remote_addr,
                   'request_uri'    => $request_uri,
                   'api_request'    => $api_request,
                   'message'        => $message,
                   'log_date'       => date('Y-m-d H:i:s')
               );
        $final_output = array();

        $payouts = new Payout();

        $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();

        $apiContext = new ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                Config::get('constants.PAYPAL_OAUTHTOKEN'),
                Config::get('constants.PAYPAL_OAUTHSECRET')
            )
        );

        try{
            $output = \PayPal\Api\Payout::get($payoutBatchId, $apiContext);
            $final_output['status'] = 1;
            $final_output['output'] = $output;

            $api_data['api_response'] = $output;
            
        }catch (\PayPal\Exception\PayPalConnectionException $ex) {
            /*echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message 
            die($ex);*/
            $final_output['status'] = 0;
            $final_output['output'] = $ex->getData();
            $api_data['api_response'] = json_encode($ex->getData());
        } catch (\Exception $ex) {
           /*ResultPrinter::printError("Get Payout Batch Status", "PayoutBatch", null, $payoutBatchId, $ex); exit(1);*/
            $final_output['status'] = 0;
            $final_output['output'] = $ex->getData();
            $api_data['api_response'] = json_encode($ex);
        }
        
        $insertin_log = Site_model::insert_get_id('api_log',$api_data);
        return $final_output;
    }

}