<?php namespace App;
use Mail;
use Braintree_ClientToken;
use Braintree_Customer;
use Braintree_PaymentMethod;
use Braintree_Subscription;
use Braintree_Transaction;
use Braintree_CreditCard;
use Config;
use App\User;
use App\CreaditCard;


class BraintreeApp  {
	
	public function __construct()
	{
		// braintree creation;
		
	}
	/**
	 * Get Client Token information
	 *
	 * @return client token id
	 */
	public function getClientToken()
	{
			
		echo $clientToken = Braintree_ClientToken::generate();
	}

	public function customerFind($cust_api_id)
	{
			
		$costumer_id = Braintree_Customer::find($cust_api_id);
		return $costumer_id;
	}
	/**
	 * Create New Customer
	 *
	 * @return customer informtion
	 */
	public function createCustomer($data,$customerId)
	{
		if(count($data)>0 && $customerId!='')
		{
			$result = Braintree_Customer::create($data);
			if($result->success)
			{
				$user = User::where('id', $customerId)  // find your user by their id
						->limit(1)  // optional - to ensure only one record is updated.
						->update(array('api_customer_id' => $result->customer->id));
				
				return "Customer Created Successfully";
				
			}
			else if($result->errors)
					{
						foreach($result->errors->deepAll() AS $error) 
						{
						  print_r($error->message . "\n");
						}
					}
		}
		else
		{
			return "CustomerId and Customer Data was Misssing.";
		}
	}
	/**
	 * delete Customer
	 *
	 * @return customer informtion
	 */
	public function deleteCustomer($customerId)
	{ 
		if($customerId!='')
		{
			$customer = Braintree_Customer::find($customerId);
			
			if(count($customer)>0)
			{  
				$result = Braintree_Customer::delete($customerId);
				
				if($result->success)
				{ 
					return "Customer Deleted Successfully";
				}
				else if($result->errors)
				{
					foreach($result->errors->deepAll() AS $error) {
					  print_r($error->message . "\n");
					}
				}
			}
			else
			{
				return "Customer Id ".$customerId." dosn't Exist";
			}
			
		}
		else
		{
			return "Client Id Dosn't Exist";
		}
		
	}
	/**
	 * update Customer
	 *
	 * @return customer informtion
	 */
	 public function updateCustomer($data,$customerId)
	{
		if(count($data)>0 && $customerId!='')
		{
			$result = Braintree_Customer::update($data);
			if($result->success)
			{
				$user = User::where('id', $customerId)  // find your user by their id
						->limit(1)  // optional - to ensure only one record is updated.
						->update(array('api_customer_id' => $result->customer->id));
				
				return "Customer Created Successfully";
				
			}
			else if($result->errors)
					{
						foreach($result->errors->deepAll() AS $error) 
						{
						  print_r($error->message . "\n");
						}
					}
		}
		else
		{
			return "CustomerId and Customer Data was Misssing.";
		}
		
	
	}
	
	/**
	 * payment method create
	 *
	 * @return success informtion
	 */
	public function paymentMethodCreate($data,$CustomerId)
	{
		if(count($data)>0)
		{
			$result = Braintree_PaymentMethod::create($data);			
			return $result;
		}
		
	}
	/**
	 * payment method delete
	 *
	 * @return success informtion
	 */
	public function paymentMethodDelete($tokenId)
	{
		$result = Braintree_PaymentMethod::delete($tokenId);
		return $result;
	}
	
	/**
	 * Transaction create
	 *
	 * @return success informtion
	 */
	 public function transactionCreate($data)
	 {
		 $result = Braintree_Transaction::sale($data);
		 return $result;
		 // if($result->success)
		 // {	
			// return "Transaction Created Successfully ";
		 // }
		// else if($result->errors)
		// {
			// foreach($result->errors->deepAll() AS $error) 
			// {
				// print_r($error->message . "\n");
			// }
		// }
	 }
	 public function submitForSettlement($transaction_id)
	 {
	 	$result=Braintree_Transaction::submitForSettlement($transaction_id);
	 	return $result;
	 }
	 public function RefundTransaction($transaction_id,$amount)
	 {
	 	$result=Braintree_Transaction::refund($transaction_id,$amount);
	 	return $result;
	 }
	 public function voidTransaction($transaction_id,$amount)
	 {
	 	$result=Braintree_Transaction::void($transaction_id,$amount);
	 	return $result;
	 }
	 
	public function CCVerify($cc_api)
	{
	   $cc = Braintree_CreditCard::find($cc_api);
		return $cc;
	}
 	
}
