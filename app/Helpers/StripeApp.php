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
	public function charge($amount,$currency,$customer_id,$card_id,$desc)
	{

			 	$charge = Stripe::charges()->create([
			        'amount' => $amount,
			        'currency' => $currency,
			        'customer' => $customer_id,
			        'card' => $card_id,
			        'description' => $desc
			      ]);
               
			 	return $charge;
   }
 }
