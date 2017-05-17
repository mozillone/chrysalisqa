<?php namespace App\Helpers;

use Usps\Rate;
use Usps\RatePackage;
use Config;

class UspsShipping  {
	
	public function domesticRate($originationZip,$destinationZip,$weight)
	{
			
			 $rate = new Rate(Config::get('constants.USPS'));
			 $package->setService(RatePackage::SERVICE_EXPRESS);
			 $package->setZipOrigination(91601);
			 $package->setZipDestination(91730);
			 $package->setPounds(59);
			 $package->setOunces(0);
			 $package->setContainer('');
			 $package->setSize(RatePackage::SIZE_REGULAR);
			 $package->setField('Machinable', true);

			 $rate->addPackage($package);
			 $rate->getRate();
			 $rate->getArrayResponse();
			 
			 if ($rate->isSuccess()) {
   				dd($rate->getArrayResponse());
			 } else {
    			echo 'Error: ' . $rate->getErrorMessage();
			 }
	
}
