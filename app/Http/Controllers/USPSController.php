<?php

namespace App\Http\Controllers;
use app\Http\Requests;
use Illuminate\Support\Facades\Request;
use Usps\Rate;
use Usps\RatePackage;

class USPSController extends Controller
{
 //402SAMPL6330
            public function index() {
              $rate = new Rate('402SAMPL6330');
// During test mode this seems not to always work as expected
//$rate->setTestMode(true);
// Create new package object and assign the properties
// apartently the order you assign them is important so make sure
// to set them as the example below
// set the RatePackage for more info about the constants
$package = new RatePackage();
$package->setService(RatePackage::SERVICE_EXPRESS);
$package->setZipOrigination(91601);
$package->setZipDestination(91730);
$package->setPounds(59);
$package->setOunces(0);
$package->setContainer('');
$package->setSize(RatePackage::SIZE_REGULAR);
$package->setField('Machinable', true);
// add the package to the rate stack
$rate->addPackage($package);
// Perform the request and print out the result
$rate->getRate();
$rate->getArrayResponse();
// Was the call successful
if ($rate->isSuccess()) {
   dd($rate->getArrayResponse());
} else {
    echo 'Error: ' . $rate->getErrorMessage();
}
}
}