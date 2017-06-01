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

 
        
    }

      public function callPartials()
    {
         Talk::setAuthUserId(Auth::user()->id);

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

        return view('messages.message', compact('messages', 'user'));
    }

    public function ajaxSendMessage(Request $request)
    {   
        $this->callPartials();
        if ($request->ajax()) {
            $rules = [
                'message-data'=>'required',
                '_id'=>'required'
            ];

            $this->validate($request, $rules);

            $body = $request->input('message-data');
            $userId = Auth::user()->id;

            if ($message = Talk::sendMessageByUserId($userId, $body)) {
                $html = view('ajax.newMessageHtml', compact('message'))->render();
                return response()->json(['status'=>'success', 'html'=>$html], 200);
            }
        }
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
        $id = Auth::user()->id;
        $this->callPartials();
        $conversations = Talk::getConversationsById($id);
        //dd($conversations);
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }

        return view('messages.conversations', compact('messages', 'user'));
    }
}
