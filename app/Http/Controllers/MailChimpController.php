<?php namespace App\Http\Controllers;
use Auth;
use config;
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

class MailChimpController extends Controller {

    public $mailchimp;
    public $listId = '07697e4b76';
    public function __construct(\Mailchimp $mailchimp)
    {

        $this->mailchimp = $mailchimp;
    }
    /****Sending email using mailchimp code starts here***/

    public function subscribe(Request $request)
    {

         $req=$request->all();
         try {
             $this->mailchimp
            ->lists
            ->subscribe(
                $this->listId,
                ['email' => $request->input('subscribe_email')]
            );
            $response['code']="200";
            $response['message']="success";
            $response['description']="Email Subscribed successfully";
          
            
        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            $response['code']="422";
            $response['message']="exists";
            $response['description']="Email is Already Subscribed";
           
            
        } catch (\Mailchimp_Error $e) {
            $response['code']="204";
            $response['message']="error";
            $response['description']="Error from MailChimp";
           
        }
        return $response;
    }




}