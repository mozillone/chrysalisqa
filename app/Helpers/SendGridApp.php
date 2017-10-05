<?php namespace App\Helpers;
use Mail;
use SendGrid;
use Config;

class SendGridApp  {
	
	public function __construct()
	{
		$this->api= new SendGrid(Config::get('services.sendgrid.api_key'));		
	}	
	public function mail($templateCode,$to,$subject,$message)
	{
			
				$url = 'https://api.sendgrid.com/';
				$user = Config::get('mail.username');
				$pass = Config::get('mail.password');
				$template_id = $this->templateId($templateCode);
				$json_string = array(

				  'to' => array(
					$to
				  ),
					'filters' => array('templates' => array('settings' => array('enable' => 1, 'template_id' => $template_id))),
					'category' => 'test_category',
					'sub' => $message
				);


				$params = array(
					'api_user'  => $user,
					'api_key'   => $pass,
					'x-smtpapi' => json_encode($json_string),					
					'to' => $to,					
					'subject'   => $subject,
					'html'      => 'testing body',
					'text'      => 'testing body',
					'from'      => Config::get('constants.FROM_EMAIL'),
				  );
				//dd($params);
				$request =  $url.'api/mail.send.json';

				$session = curl_init($request);
				curl_setopt ($session, CURLOPT_POST, true);
				curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
				curl_setopt($session, CURLOPT_HEADER, false);
				curl_setopt($session, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

				// obtain response
				$response = curl_exec($session);
				curl_close($session);

				// print everything out
				return $response;
	}
	
	public function templateId($code)
	{  
		switch($code)
		{
			case 'FORGOT_PASSWORD': {
				return 'e8f9c1ab-bfa0-4d76-ad7a-b2287401d15b'; break;
			}
			case 'ACTIVATION_LINK': {
				return 'd5bc2508-cd55-4ba9-9f9a-14c6bd415492'; break;
			}
			case 'GENERAL_LINK': {
				return '45e737fa-2443-4906-8da7-29c57fd57f98'; break;
			}
			case 'LISTING_CONFIRMATION': {
				return '2372d7ba-db42-463f-920c-1159f41f81d8'; break;
			}
			case 'CONTACT_EMAIL': {
				return 'dd5b831b-cfd9-44b3-8a60-5ce1fb303897'; break;
			}
		}
		
	}
	
 	
}
