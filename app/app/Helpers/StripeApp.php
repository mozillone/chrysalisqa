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
   public function charge_capture($amount,$currency,$customer_id,$card_id,$desc,$capture)
   {
   	       $charge = Stripe::charges()->create([
			        'amount' => $amount,
			        'currency' => $currency,
			        'customer' => $customer_id,
			        'card' => $card_id,
			        'description' => $desc,
			        'capture' => $capture
			      ]);
               
			 	return $charge;
   }
   public function find_capture($trans_id)
   {
		   	$charge = Stripe::charges()->find($trans_id);
		    return $charge;
   }
   public function charge_uncapture($trans_id)
   {
		   	$charge = Stripe::charges()->capture($trans_id);
		    return $charge;
   }
    public function RefundTransaction($transaction_id,$amount)
	 {
	 	$result=Stripe::refunds()->create($transaction_id,$amount);
	 	return $result;
	 }
	 public function voidTransaction($transaction_id)
	 {
	 	$result=Stripe::refunds()->create($transaction_id);
	 	return $result;
	 }
  
}
