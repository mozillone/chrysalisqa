<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\Costumes;
use App\Category;
use Session;
use Hash;
use DB;
use Response;
use Mail;
use Meta;
class TicketController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
        Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
	}
	/******Support contact page code starts here****/
	public function supportContact(){
        Meta::set('title', 'Support And Contact');
        Meta::set('description', 'Support And Contact - Chrysalis');

		if(Auth::user()){
			$userid=Auth::user()->id;
			$support_details=DB::table('users')->where('id',$userid)->first();
			return view('frontend.tickets.support',compact('support_details'));
		}else{
		return view('frontend.tickets.support',compact(''));
		}
		
		//print_r($support_details);
		
	}
	/******Insert Ticket code starts here****/
	public function supportInsert(Request $request){
		$req=$request->all();
		//echo "<pre>"; print_r($req);die;
		
		$token=$request->_token;
		$reason=$request->reason;
		$fullname=$request->fullname;
		$username=$request->username;
		$orderid=$request->orderid;
		$email=$request->email;
		$tickettype=$request->ticket_type;
		$ticket_message=$request->ticket_message;
		/****If user is login ****/
		if(Auth::user()){
			$userid=Auth::user()->id;
		/*****Ticket Id Generation****/
		$ticket_no=DB::table('tickets')->select('*')->get();
	    $count=count($ticket_no);
	    //if count greater than zero increment the sku number else insert the sku number
	    if($count > 0){
	    //Get the last sku number
	    $ticket_num=DB::table('tickets')->max('id');
	    $ticket_gener=DB::table('tickets')->select('ticket_id as ticketid')->where('id',$ticket_num)->first();
	    $tic_no=$ticket_gener->ticketid;
	    $ticket_org=str_replace('CSSP', '', $tic_no);
		$ticket_org_val=$ticket_org+1;
		$ticket_val='CSSP'.'00000'.$ticket_org_val;
		
		}
		else{
			$ticket_val='CSSP'.'00000'.'1';
		}
		//Inserting ticket values code starts here***/
		$tickets_array=array('ticket_id'=>$ticket_val,
			'order_id'=>$orderid,
			'ticket_type'=>$tickettype,
			'ticket_message'=>$ticket_message,
			'ticket_reason'=>$reason,
			'ticket_userid'=>$userid,
			'ticket_createddate'=>date("Y-m-d H:i:s"),
			'ticket_status'=>'1',
			'ticket_priority'=>'0',
			'ticket_assigned_to'=>'0',
		);
		
		$insert_ticket=DB::table('tickets')->insertGetId($tickets_array);
		if($insert_ticket){
			 //Create a Conversation id for ticket 
			 $coversation_array=array('type'=>"support",
			 	'user_one'=>$userid,
			 	'user_two'=>'1',
			 	'type_id'=>$orderid,
			 	'subject'=>$reason,
			 	'created_at'=>date('y-m-d H:i:s'),
			 	);
			// $insert_conversation=DB::table('conversations')->insert($coversation_array);
			 $insert_conversation=DB::table('conversations')->insertGetId($coversation_array);
            if($insert_conversation){
			 	//Craete a message thread code starts here 
            	//update ticksets table with conversation id
            	$update_tickets=array('conversation_id'=>$insert_conversation);

            	$where=array('id'=>$insert_ticket);
				$update_tickets=DB::table('tickets')->where($where)->update($update_tickets);
            	if($update_tickets){
            		//Insert Message into message table code starts here
            		
            		$message_array  = array('message'=>$ticket_message,
                                    'is_seen'=>'0',
                                    'deleted_from_sender'=>'0',
                                    'deleted_from_receiver'=>'0',
                                    'user_id'=>$userid,
                                    'user_name'=>Auth::user()->display_name,
                                    'conversation_id'=>$insert_conversation,
                                    'created_at'=>date('y-m-d H:i:s'));
            		$insert_message=DB::table('messages')->insert($message_array);
            		if($insert_message){
            			$all_data = array();
						$all_data['username'] = $request->username;
						$all_data['subject'] = $request->reason;
						$all_data['orderid'] = $request->orderid;
						$all_data['email'] = $request->email;
						$all_data['tickettype']=$request->ticket_type;
						$all_data['message']=$request->ticket_message;
					/*****Mail to admin code starts here****/
            		$sent=Mail::send('emails.tickets',array("data"=>$all_data), function ($message) use($req) {
                        $mailTo = config('services.chyrsalis_mail_add.support_email');
					$message->to($mailTo);
				    $message->subject('Tickets'); 
				   



				});

            			Session::flash('success', 'Ticket Added Successfully');
            		}else {
            			Session::flash('fail', 'Unable To Add Message');
            		}


            	}else {
            		Session::flash('fail', 'Unable To Add Conversation');
            	}
				
			 	



			 }else {
			 	Session::flash('fail', 'Unable To Add Ticket');
			 }

			
           
		}else {
			Session::flash('success', 'Unable To Add Ticket');
          
		}
		 return Redirect::back();
	}else{
		$all_data = array();
						$all_data['username'] = $request->username;
						$all_data['subject'] = $request->reason;
						$all_data['orderid'] = $request->orderid;
						$all_data['email'] = $request->email;
						$all_data['tickettype']=$request->ticket_type;
						$all_data['message']=$request->ticket_message;
					/*****Mail to admin code starts here****/
            		$sent=Mail::send('emails.tickets',array("data"=>$all_data), function ($message) use($req) {
                    $mailTo = config('services.chyrsalis_mail_add.support_email');
					$message->to($mailTo);
				    $message->subject('Tickets'); 
				   



				});

            			Session::flash('success', 'Ticket Added Successfully');
            			 return Redirect::back();

	}
		 
	
		
		

	}
	
	
	
	
}
