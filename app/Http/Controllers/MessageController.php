<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\Auth\Guard;
use App\User;
use Illuminate\Http\Request;
use Nahid\Talk\Facades\Talk;
use View;
use Redirect;
use App\Conversations;
use Session;
use DB;
use Meta;
class MessageController extends Controller
{
    protected $auth;
    
    public function __construct(Guard $auth)
    {  
        $this->middleware(function ($request, $next) {
              if(!Auth::check()){
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        });

        Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
        
    }

      public function callPartials()
    {
         Talk::setAuthUserId(Auth::user()->id);
//echo "string"; exit;
        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();

            $view->with(compact('threads'));
        });
    }

    public function chatHistory($id)
    {  
        $this->callPartials();
        $conversations = Talk::getConversationsById($id);
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }
        $get_con = DB::table('conversations')
            ->leftjoin('url_rewrites','url_rewrites.url_offset','=','conversations.costume_id')
            ->leftjoin('costume_image','costume_image.costume_id','=','conversations.costume_id')
            ->where('conversations.id',$id)->first();

        $make_seen = DB::table('messages')->where('conversation_id',$id)->update(['is_seen'=>'1']);
        return view('messages.message', compact('messages', 'user','get_con'));
    }

    public function ajaxSendMessage(Request $request)
    {   //echo "<pre>";print_r($request->input('message-data'));die;
        $this->callPartials();
        if ($request->ajax()) {
            $rules = [
                'message-data'=>'required',
                '_id'=>'required'
            ];

            $this->validate($request, $rules);

            $request = $request->all();
            $userId = Auth::user()->id;

            if ($message = $this->sendMessageByUserId($userId, $request)) {
                $html = view('ajax.newMessageHtml', compact('message'))->render();
                return response()->json(['status'=>'success', 'html'=>$html], 200);
            }
        }
    }

    public function sendMessageByUserId($receiverId, $message)
    {
         //echo "<pre>";print_r($message);die;
        $conversationId = $message['_id'];
        $message = $message['message-data'];
        $message = array(
            'message' => $message,
            'conversation_id' => $conversationId,
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->display_name,
            'is_seen' => 0,
            'created_at'=>date('y-m-d H:i:s'),
        );

        $message = DB::table('messages')->insertGetId($message);
         $get_details =  DB::table('messages')->where('id',$message)->first();  

        return $get_details;
    }

    public function ajaxDeleteMessage(Request $request, $id)
    {
        $this->callPartials();
        if ($request->ajax()) {
            if(Talk::deleteMessage($id)) {
                return response()->json(['status'=>'success'], 200);
            }

            return response()->json(['status'=>'errors', 'msg'=>'something went wrong'], 401);
        }
    }

    public function tests()
    {$this->callPartials();
        dd(Talk::channel());
    }

    public function converstationsofUser(){
        Meta::set('title', 'Messages');
        Meta::set('description', 'Messages - Chrysalis');

        $id = Auth::user()->id;
        /*$this->callPartials();
        $conversations = Talk::getConversationsById($id);
        //dd($conversations);
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }*/
        $this->data = array();
        $this->data['conversations_sent'] = DB::Select('SELECT usr.first_name,usr.last_name,cnvs.id,cnvs.created_at,cnvs.subject,cnvs.type_id,cnvs.costume_id,cnvs.type,msg.is_seen,msg.user_id,msg.conversation_id,costume_image.image,costume_url.url_key,(SELECT cm1.message FROM cc_messages as cm1  WHERE cnvs.id = cm1.conversation_id ORDER BY created_at DESC LIMIT 1) as message FROM `cc_conversations` as cnvs LEFT JOIN cc_messages as msg on msg.conversation_id=cnvs.id LEFT JOIN cc_costume_image as costume_image on costume_image.costume_id=cnvs.costume_id LEFT JOIN cc_url_rewrites as costume_url on costume_url.url_offset=cnvs.costume_id LEFT JOIN cc_users as usr on usr.id=cnvs.user_one where cnvs.user_one='.Auth::user()->id.' group by cnvs.id');
        $this->data['conversations_inbox'] = DB::Select('SELECT usr.first_name,usr.last_name,cnvs.id,cnvs.created_at,cnvs.subject,cnvs.type_id,cnvs.costume_id,cnvs.type,msg.is_seen,msg.user_id,msg.conversation_id,costume_image.image,costume_url.url_key,(SELECT cm1.message FROM cc_messages as cm1  WHERE cnvs.id = cm1.conversation_id ORDER BY created_at DESC LIMIT 1) as message FROM `cc_conversations` as cnvs LEFT JOIN cc_messages as msg on msg.conversation_id=cnvs.id LEFT JOIN cc_costume_image as costume_image on costume_image.costume_id=cnvs.costume_id LEFT JOIN cc_url_rewrites as costume_url on costume_url.url_offset=cnvs.costume_id LEFT JOIN cc_users as usr on usr.id=cnvs.user_one where cnvs.user_two='.Auth::user()->id.' group by cnvs.id');
        $msgs_count = DB::Select('SELECT count(cnvs.id) as count_dt FROM cc_messages as msg LEFT JOIN `cc_conversations` as cnvs on msg.conversation_id=cnvs.id where msg.is_seen="0" AND (cnvs.user_two ='.Auth::user()->id.' OR cnvs.user_one = '.Auth::user()->id.') and msg.user_id != '.Auth::user()->id.'');
        $msgs_inbox = DB::Select('SELECT count(cnvs.id) as count_dt FROM cc_messages as msg LEFT JOIN `cc_conversations` as cnvs on msg.conversation_id=cnvs.id where msg.is_seen="0" AND (cnvs.user_two ='.Auth::user()->id.') and msg.user_id != '.Auth::user()->id.'');
        $msgs_sent = DB::Select('SELECT count(cnvs.id) as count_dt FROM cc_messages as msg LEFT JOIN `cc_conversations` as cnvs on msg.conversation_id=cnvs.id where msg.is_seen="0" AND (cnvs.user_one = '.Auth::user()->id.') and msg.user_id != '.Auth::user()->id.'');
       // echo "<pre>";print_r($this->data);die;
        //echo "<pre>";print_r($this->data['conversations_inbox']);die;
        /*$this->data['conversations_inbox'] = DB::table('conversations')
        ->where('conversations.user_two' ,$id)
        ->leftJoin('messages','conversations.id','messages.conversation_id')
        ->leftJoin('users','conversations.user_two','users.id')
        ->orderBy('messages.id','DESC')
        ->limit(1)
        ->get();*/
     //   dd($msgs_count);
        return view('messages.conversations')->with($this->data)->with('msgs_count',$msgs_count)->with('msgs_inbox',$msgs_inbox)->with('msgs_sent',$msgs_sent);
    }

    public function converstationsDelete(Request $request){
        //echo "<pre>";print_r($request->all());die;
        $conversation_delete = Talk::deleteConversations($request->conversation_id);
        return "success";
    }
}
