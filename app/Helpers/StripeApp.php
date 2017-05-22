<?php namespace App\Helpers;

use Stripe;
use Config;

class StripeApp  {
	
	public function customers($params)
	{
			
			    $customer = Stripe::customers()->create([
				    'email' => $params,
				]);
			
				return $customer;
	}
	public function customerFind($api_id)
	{
			
			    $customer = Stripe::customers()->find($api_id);
				return $customer;
	}
	public function customerDelete($user_api)
	{
	    $customer = Stripe::customers()->delete($user_api);
		return $customer;
	}
	public function CCVerify($user_api,$cc_api)
	{
			
			    $cc = Stripe::cards()->find($user_api,$cc_api);
				return $cc;
	}
	public function cards($id,$name,$number,$exp_month,$cvv,$exp_year)
	{          
	
				$card = Stripe::cards()->create($id, [
					'name'      => $name,
				    'number'    => $number,
				    'exp_month' => $exp_month,
				    'cvc'       => $cvv,
				    'exp_year'  => $exp_year,
					]);
                
				return $card;
	}
	public function CCDelete($user_api,$cc_api)
	{
	    $cc = Stripe::cards()->delete($user_api,$cc_api);
		return $cc;
	}
	public function charge($amount,$currency,$customer_id,$card_id)
	{

			 	$charge = Stripe::charges()->create([
			        'amount' => $amount,
			        'currency' => $currency,
			        'customer' => $customer_id,
			        'card' => $card_id
			      ]);
               
			 	return $charge;
   }
  
}
