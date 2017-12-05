<?php
namespace App\Http\Controllers\Admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use DB;
use Session;
use App\Helpers\SiteHelper;
use Hash;
use Response;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use App\Costumes;
use App\Helpers\Site_model;
use Mail;

class TicketController extends Controller
{
    protected $messageBag = null;
    

    public function __construct()
    {
      $this->sitehelper = new SiteHelper();
      $this->middleware(function ($request, $next) {
          if(!Auth::check()){
            return Redirect::to('/admin/login')->send();
          }
          else{
               return $next($request);
          }
      });
    }
	/*
	Method Name : costumesList()
	Purpose :costumesList Method is  used to get the data of all costumes from the database.
	*/
	public function ticketsList(){
	   /*****Costumes View Page***/
      
	    $title=Auth::user()->display_name." Support List";
        return view('admin.tickets.tickets_list',compact('title'));
	}
	public function getallTickets(Request $request){
       $roleid=Auth::user()->role_id;
       $userid=Auth::user()->id;
     	$ticketslist = DB::table('tickets')
				->leftjoin('users', 'tickets.ticket_userid', '=', 'users.id')
				->select('tickets.id as id','tickets.ticket_status as ticket_status','tickets.order_id as orderid','tickets.ticket_type as type','tickets.ticket_id as ticketid','users.display_name as customer_name',DB::Raw('DATE_FORMAT(cc_tickets.ticket_createddate,"%m/%d/%y %h:%i %p") as createdate'));
			switch($roleid){
        case '2':
        $ticketslist->where('tickets.ticket_assigned_to',$userid);
        break;
      }
      $tickets=$ticketslist->get();


		 return Datatables::of($tickets)
      ->addColumn('actions', function ($ticket) {
        return '<a href="/manage-tickets/'.$ticket->id.'" class="btn btn-xs btn-primary" ><i class="fa fa-pencil-square-o"></i> </a>
                     <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deletTicket('.$ticket->id.');" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash-o"></i> </a>
                    ';
      })
      ->editColumn('status', function ($ticket) {
        /*$a = $ticket->ticket_status == 1?'checked':'';
        
        return '<label class="switch">
                                    <input type="checkbox" '.$a.' class="status" id="'.$ticket->id.'" onClick="ticketStatus('.$ticket->id.','.$ticket->ticket_status.');">
                                    <div class="slider round"></div>
                                </label>';*/
        if($ticket->ticket_status == '1'){
          $status = "Open";
        }
        else if($ticket->ticket_status == '0'){
          $status = "Pending";
        }
        else{
          $status = "Closed";
        }
        return "<span>".$status."</span>";
      })
      ->make(true);

           
	}
  /*******mnaage tickets code starts here***/
  public function manageTickets($id){

          //Support Users Listing Code starts here***/
          $supportusers=DB::table('users')->select('*')->where('role_id','=','2')->get();

          $title=Auth::user()->display_name." Support List";
          $ticketid=$id;
          $where=array('tickets.id'=>$ticketid);
          $conversations=DB::table('tickets')
          ->leftJoin('conversations','conversations.id','=','tickets.conversation_id')
          ->leftJoin('users','users.id','=','conversations.user_one')
          ->select('tickets.id as id','tickets.conversation_id as conversation_id',
            'tickets.ticket_reason as title',
            'tickets.ticket_id as ticketid',
            'users.display_name as user',
            'users.role_id as roleid',
            'tickets.ticket_id as ticketid',
            'tickets.order_id as orderid',
            'tickets.ticket_status as status ',
            'tickets.ticket_priority as priority',
            'tickets.ticket_assigned_to as ticketassigned',
            DB::Raw('DATE(cc_tickets.ticket_createddate) as createddate')
             )->where($where)->first();
         
          $coversationid=$conversations->conversation_id;
          $reason_title=$conversations->title;
          $title=$conversations->title;
          $ticketid=$conversations->ticketid;
          $user=$conversations->user;
          $orderid=$conversations->orderid;
          $main_ticketid=$conversations->id;
          $status=$conversations->status;
          
           $priority=$conversations->priority;
          $assigneduser=$conversations->ticketassigned;
          $createddate=$conversations->createddate;
          $roleid=$conversations->roleid;
          $messages=DB::table('messages')
          ->leftJOin('users','users.id','=','messages.user_id')
          ->leftjoin('tickets','tickets.conversation_id','=','messages.conversation_id')
          ->select('messages.id as messageid','messages.message as usermessage','users.email as email','users.phone_number as phone',
            'tickets.ticket_reason as reason','tickets.order_id as orderid','messages.user_id as userid','users.role_id as roleid','users.display_name as username','tickets.ticket_id as ticketid','users.user_img as image', DB::Raw('DATE(cc_messages.created_at) as createddate'))->
           where('messages.conversation_id',$coversationid)->get();
    
       return view('admin.tickets.conversation_list',compact('title','messages','reason_title','ticketid',
        'user','orderid','coversationid','supportusers','main_ticketid','status','priority','assigneduser',
        'createddate','roleid'));
 }
/*****Insert support message code starts here***/
public function insertSupportMessage(Request $request){
  $userid=Auth::user()->id;
       $message_array  = array('message'=>$request->message_theard,
                                    'is_seen'=>'0',
                                    'deleted_from_sender'=>'0',
                                    'deleted_from_receiver'=>'0',
                                    'user_id'=>$userid,
                                    'user_name'=>Auth::user()->display_name,
                                    'conversation_id'=>$request->conversation_id,
                                    'created_at'=>date('y-m-d H:i:s'));
      $converstion_id = Site_model::insert_get_id('messages',$message_array);
      return "success";
  }
  /*******Change ticket status code starts here****/
  public function changeTicketstatus(Request $request) {
        $status = $request->input('status') == 1?0:1;
        $id     = $request->input('id');
        $user = DB::table('tickets')->where('id', $id)->update(['ticket_status' => trim($status)]);
        $user == 1?true:false;
        return $user;
    }
  /********Delete ticket code starts here***/
  public function deleteTicket($id) {

    $condition = array('id' => $id);
    $delete    = Site_model::delete_single('tickets', $condition);
    if ($delete) {
      Session::flash('success', 'Ticket Deleted Successfully.');
    } else {
      Session::flash('fail', 'Unable To delete Ticket');
    }

    return redirect('/tickets-list');
  }
  /*****Search Tickets Code Starts Here****/
  public function searchTickets(Request $request){
    $req=$request->all();

    $keyword=$request->keyword;
    $customer_name=$request->name;
    $status=$request->status;
    $type=$request->type;
    $roleid=Auth::user()->role_id;
    $userid=Auth::user()->id;
    $ticketslist = DB::table('tickets')
        ->leftjoin('users', 'tickets.ticket_userid', '=', 'users.id')
        ->select('tickets.id as id','tickets.ticket_status as ticket_status','tickets.order_id as orderid','tickets.ticket_type as type','tickets.ticket_id as ticketid','users.display_name as customer_name',DB::Raw('DATE_FORMAT(cc_tickets.ticket_createddate,"%m/%d/%y %h:%i %p") as createdate'));
      switch($roleid){
        case '2':
        $ticketslist->where('tickets.ticket_assigned_to',$userid);
        break;
      }
      if($status!=""){
        $ticketslist->where('tickets.ticket_status',$status);
      }
      if($type!=""){
        $ticketslist->where('tickets.ticket_type',$type);
      }
      if($customer_name!=""){
        $ticketslist->where('users.display_name', 'LIKE', "%".$customer_name."%");
      }
      if($keyword!=""){
        $ticketslist->where('tickets.ticket_reason', 'LIKE', "%".$keyword."%");
      }
      $tickets=$ticketslist->get();


     return Datatables::of($tickets)
      ->addColumn('actions', function ($ticket) {
        return '<a href="/manage-tickets/'.$ticket->id.'" class="btn btn-xs btn-primary" title="View Ticket Conversation"><i class="fa fa-pencil-square-o"></i> </a>
                     <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deletTicket('.$ticket->id.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
                    ';
      })
      ->editColumn('status', function ($ticket) {
        /*$a = $ticket->ticket_status == 1?'checked':'';
        return '<label class="switch">
                                    <input type="checkbox" '.$a.' class="status" id="'.$ticket->id.'" onClick="ticketStatus('.$ticket->id.','.$ticket->ticket_status.');">
                                    <div class="slider round"></div>
                                </label>';*/
        if($ticket->ticket_status == '1'){
          $status = "Open";
        }
        else if($ticket->ticket_status == '0'){
          $status = "Pending";
        }
        else{
          $status = "Closed";
        }
        return "<span>".$status."</span>";
      })
      ->make(true);

  }
  /******Support Listing users code starts here***/
  public function supportUsers(){
    $title=Auth::user()->display_name." Support List";
     return view('admin.tickets.support_list',compact('title'));
  }
  public function getSupportUsers(Request $request){
    $req=$request->all();
    $userslist=DB::table('users as user')
    ->select('user.id',DB::Raw("CONCAT(cc_user.first_name,' ',cc_user.last_name) as display_name")  ,'user.phone_number','user.email','user.active','user.deleted',DB::Raw('DATE_FORMAT(cc_user.created_at,"%m/%d/%y %h:%i %p") as date_format'),DB::Raw('DATE_FORMAT(cc_user.created_at,"%m/%d/%y %h:%i %p") as lastlogin'))
    ->orderby('user.created_at','DESC')
    ->where('user.role_id','=','2')
    ->get();
    return Datatables::of($userslist)
      ->addColumn('credit', function ($users) {
        return '$0.00';
      })
     
      ->addColumn('isseller', function ($users) {
        return "No";
      })
      ->addColumn('actions', function ($users) {
        return '<a href="/manage-tickets/'.$users->id.'" class="btn btn-xs btn-primary" title="View Ticket Conversation"><i class="fa fa-pencil-square-o"></i> </a>
                     <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deletTicket('.$users->id.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
                    ';
      })
      ->editColumn('status', function ($users) {
        $a = $users->active == 1?'checked':'';
        return '<label class="switch">
                                    <input type="checkbox" '.$a.' class="status" id="'.$users->id.'" onClick="ticketStatus('.$users->id.','.$users->active.');">
                                    <div class="slider round"></div>
                                </label>';
      })
      ->make(true);

  }
  public function updateSupport(Request $request){
    $req=$request->all();
    $ticketid=$request->main_ticketid;
    $status=$request->status;
    $priority=$request->priority;
    $assignedto=$request->supportuser;
    $orderid=$request->orderid;
    $updatearray=array('ticket_status'=>$status,
      'ticket_priority'=>$priority,
      'ticket_assigned_to'=>$assignedto,
      'order_id'=>$orderid,
      'ticket_updateddate'=>date("Y-m-d H:i:s"));
    $where=array('id'=>$ticketid);
    $update_ticket=DB::table('tickets')->where($where)->update($updatearray);
    if($update_ticket){
      /*****Email sending code starts her***/
      /*****Get the details of ticket code starts her***/
      $ticket_details=DB::table('tickets as t')
      ->leftJoin('users as u','u.id','=','t.ticket_assigned_to')
      ->select('t.ticket_id as ticket_id',
        't.order_id as order_id',
        't.ticket_type as ticket_type',
        't.ticket_status as ticket_status',
        't.ticket_priority as ticket_priority',
        'u.display_name as username'
        )
      ->where('t.id',$ticketid)->first();
      
      
            $all_data = array();  
            $all_data['ticket_id'] = $ticket_details->ticket_id;
            $all_data['order_id'] = $ticket_details->order_id;
            $all_data['ticket_type'] = $ticket_details->ticket_type;
            $all_data['ticket_status'] = $ticket_details->ticket_status;
            $all_data['ticket_priority']=$ticket_details->ticket_priority;
            $all_data['username']=$ticket_details->username;


          /*****Mail to admin code starts here****/
          $sent=Mail::send('emails.tickets_status',array("data"=>$all_data), function ($message) use($req) {
              $mailTo = config('services.chyrsalis_mail_add.support_email');
          $message->to($mailTo);
          $message->subject('Tickets');
          });
      Session::flash('success', 'Ticket Assigned Successfully');
      return Redirect::back();

    }else{
      Session::flash('fail', 'Unable To Update Ticket Infoirmation');
      return Redirect::back();

    }



  }
  /*****Update Support Message given by supporter***/
  public function updateSupportMessage(Request $request){
     $req=$request->all();
    
     $status=$request->status;
     $ticketid=$request->ticketid;
     $where=array('id'=>$ticketid);
     $updatearray=array('ticket_status'=>$status,
      'ticket_updateddate'=>date("Y-m-d H:i:s"));
     $update_ticket=DB::table('tickets')->where($where)->update($updatearray);
     if($update_ticket){
      Session::flash('success', 'Status Updated Successfully');
      return "success";
     }else{
      Session::flash('success', 'Unable To Update Status');
      return "fail";
      

    }

  }

    
}


