<?php namespace App\Helpers;

use Config;
use DB;
use App\Helpers\Site_model;
use Log;
class Paypal  {
    public static function checkPaypalId($data)
       {  
        //echo "string";die;
            if(count($data)==0)
            {
                
                return false;
            }
            
            $paypalEmail  = $data['paypal_email'];
            $paypalFirstName = $data['fname'];
            $paypalLastName = $data['lname'];            
             // echo "<pre>";print_r($data);die;
            $mode = "live";
            try{            
                $sandbox="sandbox";
                $apiAppID = "APP-80W284485P519543T";
                if($mode == 'sandbox')
                {
                   // $apiAppID = "APP-80W284485P519543T";
                    $url = trim("https://svcs.".$sandbox.".paypal.com/AdaptiveAccounts/GetVerifiedStatus");

                        //echo $url;die;
                    $apiUserName = 'sbasireddy_api1.dotcomweavers.com'; // Put Api user name here
                    $apiPassword =  'ZFVZNUDSPSJJ5WXV'; // Put Api password here
                    $apiSignature =  'AFcWxV21C7fd0v3bYYYRCpSSRl31A376jcebKr6QW7ZvLOrsncZxqe6a'; // Put Api Signature here
                    //Default App ID for Sandbox    
                }
                else
                {
                    //$apiAppID = "APP-80W284485P519543T"; // put production appId here
                    $url = trim("https://svcs.paypal.com/AdaptiveAccounts/GetVerifiedStatus");

                          //echo $url;die;
                    $apiUserName = 'max_api1.chrysaliscostumes.com'; // Put Api user name here
                    $apiPassword =  'T3EVG48KLGQUK72F'; // Put Api password here
                    $apiSignature =  'AiPC9BjkCyDFQXbSkoZcgqH3hpacA9wbOTVWoxe3MM5zxq4wIaS-sBgD'; // Put Api Signature here
                    //Default App ID for LIVE
                }

                $url = Config::get('constants.PAYPAL_USERVERIFY_URL');
                
                //echo $url;die;
                $apiUserName = Config::get('constants.PAYPAL_APIUSERNAME'); // Put Api user name here
                $apiPassword =  Config::get('constants.PAYPAL_APIPASSWORD'); // Put Api password here
                $apiSignature =  Config::get('constants.PAYPAL_APISIGNATURE'); // Put Api Signature here
                //Default App ID for Sandbox    

                
                $apiRequestFormat = "NV";
                $apiResponseFormat = "JSON";
                $actionType="GetVerifiedStatus";
                $bodyparams = array (
                    "emailAddress"=>$paypalEmail,
                    //"firstName"=>$paypalFirstName,
                    //"lastName"=>$paypalLastName,
                    "matchCriteria"=>"NONE",
                    );

                $bodyData = http_build_query($bodyparams, "", chr(38));
                $headers = array(
                "X-PAYPAL-SECURITY-USERID: ".$apiUserName,
                "X-PAYPAL-SECURITY-PASSWORD: ".$apiPassword,
                "X-PAYPAL-SECURITY-SIGNATURE: ".$apiSignature,
                "X-PAYPAL-REQUEST-DATA-FORMAT: ".$apiRequestFormat,
                "X-PAYPAL-RESPONSE-DATA-FORMAT: ".$apiResponseFormat,
                "X-PAYPAL-APPLICATION-ID: ".'APP-80W284485P519543T',
                );
                  Log::info($headers);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSLVERSION, 6);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $keyArray = json_decode(curl_exec($ch), true);
                Log::info($keyArray);
                //echo "<pre>";print_r($keyArray);die;
                if (curl_errno($ch) != 0)
                {
                    $message = "Can't connect to PayPal to get Verified Status for given paypal account";  
                    $message = curl_error($ch);
                    curl_close($ch);  
                    return false;
                }
                
                curl_close($ch);  
                $data = array();
                if ($keyArray['responseEnvelope']['ack']== "Success")
                {  
                     //$data['error'] = $keyArray['error'][0]['message'];
                     $data['status'] = $keyArray['responseEnvelope']['ack'];
                     return $data;
                }
                else {
                    $data['error'] = $keyArray['error'][0]['message'];
                    $data['status'] = $keyArray['responseEnvelope']['ack'];   // Paypal Id Not Exist
                    return $data;
                }
            }catch(Exception $e) {  
                 $message = $e->getMessage();  
                return false;
            }          
        }

   
    }
