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
use App\Helpers\PaypalPayout;
use App\Helpers\Paypal;
use Illuminate\Support\Collection;

class ReportsController extends Controller
{
    /****Revenue reports code starts here***/
    public function revenueReports(){
        $heading="Reports";
        $create="Create Report";
        $costumeCategory = DB::table('category')->select('category_id','name')->get();
        return view('admin.reports.sales-reports',compact('heading','create','costumeCategory'));
    }
    /****Reports get data code starts here***/
    public function getallRevenues(Request $request){
        $transactions=DB::table('transactions as t')
            ->leftJoin('users','users.id','=','t.user_id')
            ->leftJoin('order_total','order_total.order_id','=','t.order_id')
            ->leftJoin('order_items','t.order_id','=','order_items.order_id')
            ->leftJoin('costume_to_category','order_items.costume_id','=','costume_to_category.costume_id')
            ->leftJoin('category','category.category_id','=','costume_to_category.category_id')
            ->select('t.id as transcactionid','t.type as type','t.amount as amount','users.display_name as username',DB::Raw('DATE_FORMAT(cc_t.created_at,"%m/%d/%y %h:%i %p") as transaction_date'),"order_total.value as shippingamount",'t.type as type',
                DB::raw("(GROUP_CONCAT(cc_order_items.costume_name SEPARATOR ',')) as `costumes`"),DB::raw("(GROUP_CONCAT(cc_category.name SEPARATOR ',')) as `category`"))
            ->orderby('t.id','DESC')
            ->orderby('order_items.costume_name','ASC')
            ->groupBy('order_items.order_id')
            ->where('order_total.title','=',"Shipping")
            ->get();
        return Datatables::of($transactions)
            ->addColumn('amount', function ($transactions_list) {
                return '$'.number_format(floatval($transactions_list->amount),2,'.','');
            })

            ->addColumn('shippingamount', function ($transactions_list) {
                return '$'.number_format(floatval($transactions_list->shippingamount),2,'.','');
            })
            ->addColumn('actions', function ($transactions_list) {
                return '<a href="/manage-tickets/'.$transactions_list->transcactionid.'" class="btn btn-xs btn-primary" title="View Ticket Conversation"><i class="fa fa-pencil-square-o"></i> </a>
<a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deletTicket('.$transactions_list->transcactionid.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
';
            })

            ->make(true);
    }

    public function searchRevenue(Request $request){

        $req = $request->all();

        $transactions = DB::table('transactions as t')
            ->leftJoin('users','users.id','=','t.user_id')
            ->leftJoin('order_total','order_total.order_id','=','t.order_id')
            ->leftJoin('order_items','t.order_id','=','order_items.order_id')
            ->leftJoin('costume_to_category','order_items.costume_id','=','costume_to_category.costume_id')
            ->leftJoin('category','category.category_id','=','costume_to_category.category_id')
            ->select('t.id as transcactionid','t.type as type','t.amount as amount','users.display_name as username',DB::Raw('DATE_FORMAT(cc_t.created_at,"%m/%d/%y %h:%i %p") as transaction_date'),"order_total.value as shippingamount",'t.type as type',
                DB::raw("(GROUP_CONCAT(cc_order_items.costume_name SEPARATOR ',')) as `costumes`"),DB::raw("(GROUP_CONCAT(cc_category.name SEPARATOR ',')) as `category`"))
            ->orderby('t.id','DESC')
            ->orderby('order_items.costume_name','ASC')
            ->groupBy('order_items.order_id')
            ->where('order_total.title','=',"Shipping");

        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date= date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['revenue_range']) && !empty($req['revenue_range']) && $req['revenue_range'] != 500){
            $range = explode('-', $req['revenue_range']);
            $transactions->whereBetween('t.amount', array($range[0], $range[1]));
        }else if(isset($req['revenue_range']) && !empty($req['revenue_range']) && $req['revenue_range'] == 500){
            $transactions->where('t.amount','>=',$req['revenue_range']);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $transactions->whereBetween('t.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $transactions->where('t.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['username']) && !empty($req['username'])){
            $transactions->where('users.display_name','LIKE','%'.$req['username'].'%');
        }
        if(isset($req['product_name']) && !empty($req['product_name'])){
            $transactions->where('order_items.costume_name','LIKE','%'.$req['product_name'].'%');
        }
        $transactionsData = $transactions->get();

        return Datatables::of($transactionsData)
            ->editColumn('transaction_date',function($transactionsData){
                return date('m/d/y h:i:s A', strtotime($transactionsData->transaction_date));
            })
            ->editColumn('amount',function($transactionsData){
                return '$'.number_format(floatval($transactionsData->amount),2,'.','');
            })
            ->editColumn('shippingamount',function($transactionsData){
                return '$'.number_format(floatval($transactionsData->shippingamount),2,'.','');
            })
            ->make(true);
    }

    public function paypalReports(){
        $heading="Reports";
        $create="Create Report";
        return view('admin.reports.paypalpayouts-reports',compact('heading','create'));
    }

  public function getallPaypal(Request $request){
  $paypots = DB::table('paypal_payouts as pp')
  ->leftJoin('users','users.id','=','pp.user_id')
  ->where('status','!=','paid')
  //->where('note',0)
  ->groupBy('pp.user_id')
  ->select('users.first_name as name','users.paypal_email as email',DB::Raw('DATE_FORMAT(cc_pp.created_at,"%m/%d/%y %h:%i %p") as date'),
    'pp.status as status',DB::raw('SUM(cc_pp.amount) as amount'),'pp.user_id as user_id','pp.id as id')
  ->get();
    return Datatables::of($paypots)
    ->addColumn('checkbox', function ($transactions_list) {
        if($transactions_list->status != 'pending'){
            return '<input type="checkbox" name="tran_id[]" value="'.$transactions_list->id.'-'.number_format(floatval($transactions_list->amount),2,'.','').'" >';
        }
      })
      ->editColumn('amount',function($paypots){
                return '$'.number_format(floatval($paypots->amount),2,'.','');
            })
        ->editColumn('status',function($paypots){
                if($paypots->status == "paid")
                    return 'Paid';
                elseif($paypots->status == "pending")
                    return 'Pending';
                else
                    return 'Not Paid';
            })    
      ->make(true);
  }
  public function getsearchPaypal(Request $request){
    //echo "<pre>";print_r($request->searchCustomername);
    //print_r($request->searchPaypalemail);die;
    $paypots = DB::table('paypal_payouts as pp')
  ->leftJoin('users','users.id','=','pp.user_id')
  //->where('status','not_paid')
  ->groupBy('pp.user_id')
  ->select('users.first_name as name','users.paypal_email as email',DB::Raw('DATE_FORMAT(cc_pp.created_at,"%m/%d/%y %h:%i %p") as date'),
    'pp.status as status',DB::raw('SUM(cc_pp.amount) as amount'),'pp.user_id as user_id','pp.id as id');
      if(($request->searchCustomername) !="") {
          $paypots->where('users.first_name', 'LIKE', "%".$request->searchCustomername."%");
        }
      if(($request->searchPaypalemail) !="") {
          $paypots->where('users.paypal_email', 'LIKE', "%".$request->searchPaypalemail."%");
      }
  $paypots=$paypots->get();
    return Datatables::of($paypots)
    ->addColumn('checkbox', function ($transactions_list) {
        return '<input type="checkbox" name="tran_id[]" value="'.$transactions_list->id.'-'.number_format(floatval($transactions_list->amount),2,'.','').'" >';
      })
      ->editColumn('amount',function($paypots){
                return '$'.number_format(floatval($paypots->amount),2,'.','');
            })
        ->editColumn('status',function($paypots){
                if($paypots->status == "paid")
                    return 'Paid';
                elseif($paypots->status == "pending")
                    return 'Pending';
                else
                    return 'Not Paid';
            })
      ->make(true);
  }

  public function BatchPayouts(Request $request){
    //echo "<pre>";print_r($request->all());die;
    $tran_id = $request->tran_id;
    if(!empty($tran_id)){
        foreach ($tran_id as $tran_idkey => $tran_id_value) {
          $explode = explode('-', $tran_id_value);
         $val = $explode[0];
         $amount = $explode[1];
         $get_details = DB::table('paypal_payouts')->where('id',$val)->first();
         if($get_details->status == "not_paid"){
              $user_id = $get_details->user_id;
              $get_paypal_email = DB::table('users')->where('id',$user_id)->first(['paypal_email']);
                //dd($get_paypal_email);
                //echo $get_paypal_email->paypal_email; echo "<br>";
              $single_payout =PaypalPayout::SinglePayout($get_paypal_email->paypal_email,$amount);
              if($single_payout['status'] == 1){
                $output = $single_payout['output'];
                $payout_batch_id = $output->batch_header->payout_batch_id;
                  $batch_status    = $output->batch_header->batch_status;
                  $sender_batch_id    = $output->batch_header->sender_batch_header->sender_batch_id;
                  $log_array = array('type'=>'seller_payout',
                    'type_id'=>$val,
                    'user_id'=>$user_id,
                    'note'=>'Seller report',
                    'payout_batch_id'=>$payout_batch_id,
                    'batch_status'=>$batch_status,
                    'sender_batch_id'=>$sender_batch_id,
                    'created_at'=>date('y-m-d H:i:s'),);
                  $insertin_log    = Site_model::insert_get_id('payout_log',$log_array);
                  //dd($batch_status);
                  if ($batch_status == "sucess") {
                    $get_details = DB::table('paypal_payouts')->where('user_id',$user_id)->update(['status'=>'paid']);

                  }
                  if ($batch_status == "PENDING") {
                    $get_details = DB::table('paypal_payouts')->where('user_id',$user_id)->update(['status'=>'pending']);
                  }
                  \Session::flash('success', "Seller payout process successfully completed.");

              }else{
                $error = $single_payout['output'];
                \Session::flash('error', $error);
              }
         }
         
      }
    }else{
        \Session::flash('info', "No seller selected.");
    }
    
    return Redirect::back();
  }

    public function sellerReport(){
        return view('admin.reports.seller_report');
    }

    public function getAllSales(){
        $sellers = DB::table('order')
            ->join('users','order.seller_id','=','users.id')
            ->select('order.created_at',DB::Raw("concat(first_name,' ',last_name) as username"),DB::Raw("count(cc_order.order_id) as total_sales"),DB::Raw("sum(cc_order.total) as transaction_amt"))
            ->where('order.order_status_id','>=',2)
            ->groupBy('users.id')
            ->having('total_sales','>',0)
            ->get();

        return Datatables::of($sellers)
            ->editColumn('transaction_amt',function($sellers){
                return '$'.number_format(floatval($sellers->transaction_amt),2,'.','');
            })
            ->make(true);

    }

    public function searchSellers(Request $request){

        $req = $request->all();

        $sellers = DB::table('order')
            ->join('users','order.seller_id','=','users.id')
            ->select('order.created_at',DB::Raw("concat(first_name,' ',last_name) as username"),DB::Raw("count(cc_order.order_id) as total_sales"),DB::Raw("sum(cc_order.total) as transaction_amt"))
            ->where('order.order_status_id','>=',2)
            ->groupBy('users.id')
            ->having('total_sales','>',0);

        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date= date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['sales_type']) && !empty($req['sales_type']) && $req['sales_type'] == 't-10'){
            $sellers->orderBy('total_sales', 'desc')->limit(10);
        }else if(isset($req['sales_type']) && !empty($req['sales_type']) && $req['sales_type'] == 't-100'){
            $sellers->orderBy('total_sales', 'desc')->limit(100);
        }else if(isset($req['sales_type']) && !empty($req['sales_type']) && $req['sales_type'] == 'w-10'){
            $sellers->orderBy('total_sales', 'asc')->limit(10);
        }else if(isset($req['sales_type']) && !empty($req['sales_type']) && $req['sales_type'] == 'w-100'){
            $sellers->orderBy('total_sales', 'asc')->limit(100);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $sellers->whereBetween('order.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $sellers->where('order.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['username']) && !empty($req['username'])){
            $sellers->having('username','LIKE','%'.$req['username'].'%');
        }
        $sellersData = $sellers->get();

        return Datatables::of($sellersData)
            ->editColumn('transaction_amt',function($sellersData){
                return '$'.number_format(floatval($sellersData->transaction_amt),2,'.','');
            })
            ->make(true);
    }

    public function eventReport(){
        $countriesList = DB::table('countries')->get();
        return view('admin.reports.event_report')->with('countriesList',$countriesList);
    }

    public function getAllEvents(){
        $events = DB::table('events')
            ->leftJoin('users','events.created_by','=','users.id')
            ->leftJoin('address_master','events.address_id','=','address_master.address_id')
            ->select('events.event_name as event_name','events.event_url as event_url','events.created_at as created_at','events.created_by as created_by','users.display_name')
            ->get();

        return Datatables::of($events)
            ->editColumn('event_url',function($events){
                return "<a href='$events->event_url' target='_blank'>".$events->event_url."</a>";
            })
            ->editColumn('created_at',function($events){
                return date('m/d/y h:i:s A', strtotime($events->created_at));
            })
            ->make(true);
    }

    public function searchEvents(Request $request){
        $req = $request->all();

        $events = DB::table('events')
            ->leftJoin('users','events.created_by','=','users.id')
            ->leftJoin('address_master','events.address_id','=','address_master.address_id')
            ->select('events.event_name as event_name','events.event_url as event_url','events.created_at as created_at','events.created_by as created_by','users.display_name');

        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date= date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $events->whereBetween('events.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $events->where('events.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['event_name']) && !empty($req['event_name'])){
            $events->where('event_name','LIKE','%'.$req['event_name'].'%');
        }
        if(isset($req['user_name']) && !empty($req['user_name'])){
            $events->where('display_name','LIKE','%'.$req['user_name'].'%');
        }

        $eventsData = $events->get();

        return Datatables::of($eventsData)
            ->editColumn('event_url',function($eventsData){
                return "<a href='$eventsData->event_url' target='_blank'>".$eventsData->event_url."</a>";
            })
            ->editColumn('created_at',function($eventsData){
                return date('m/d/y h:i:s A', strtotime($eventsData->created_at));
            })
            ->make(true);
    }

    public function blogReport(){
        $blogCategories = DB::table('blog_categories')
            ->select('id', 'name')
            ->get();
        return view('admin.reports.blog_report')->with('blogCategories',$blogCategories);
    }

    public function getAllBlog(){
        $blogPosts = DB::table('blog_posts')
            ->leftJoin('blog_categories','blog_posts.category_id','=','blog_categories.id')
            ->leftJoin('users','blog_posts.user_id','=','users.id')
            ->select('blog_posts.title','blog_posts.created_at as created_at','blog_categories.name as category','blog_posts.tags as tags',DB::Raw("concat(first_name,' ',last_name) as posted_by"))
            ->get();

        return Datatables::of($blogPosts)
            ->editColumn('created_at',function($blogPosts){
                return date('m/d/y h:i:s A', strtotime($blogPosts->created_at));
            })
            ->make(true);
    }

    public function searchBlog(Request $request){
        $req = $request->all();

        $blogPosts = DB::table('blog_posts')
            ->leftJoin('blog_categories','blog_posts.category_id','=','blog_categories.id')
            ->leftJoin('users','blog_posts.user_id','=','users.id')
            ->select('blog_posts.title','blog_posts.description as description','blog_posts.created_at as created_at','blog_categories.id as category_id','blog_categories.name as category','blog_posts.tags as tags',DB::Raw("concat(first_name,' ',last_name) as posted_by"));

        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date= date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $blogPosts->whereBetween('blog_posts.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $blogPosts->where('blog_posts.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['post_name']) && !empty($req['post_name'])){
            $blogPosts->where('blog_posts.title','LIKE','%'.$req['post_name'].'%');
        }
        if(isset($req['desc_content']) && !empty($req['desc_content'])){
            $blogPosts->where('description','LIKE','%'.$req['desc_content'].'%');
        }
        if(isset($req['tags']) && !empty($req['tags'])){
            $blogPosts->where('tags','LIKE','%'.$req['tags'].'%');
        }
        if(isset($req['category_id']) && !empty($req['category_id'])){
            $blogPosts->where('category_id','=',$req['category_id']);
        }

        $blogData = $blogPosts->get();

        return Datatables::of($blogData)
            ->editColumn('created_at',function($blogData){
                return date('m/d/y h:i:s A', strtotime($blogData->created_at));
            })
            ->make(true);
    }

    public function productReport(){
        return view('admin.reports.product_report');
    }

    public function getAllProducts(){
        $query = "SELECT cc_costume_description.name, TRUNCATE( (weight_pounds + (weight_ounces/16)), 2) as weight, (SELECT GROUP_CONCAT(attribute_option_value SEPARATOR ' X ') FROM cc_costume_attribute_options WHERE cc_costume_attribute_options.costume_id = cc_costumes.costume_id and cc_costume_attribute_options.attribute_id IN (22,23,24) ) as dimensions, (SELECT attribute_option_value FROM cc_costume_attribute_options WHERE cc_costume_attribute_options.costume_id = cc_costumes.costume_id and cc_costume_attribute_options.attribute_id = 2) as cosplay, cc_costumes.condition, cc_costumes.price, cc_users.display_name  FROM `cc_costumes`  LEFT JOIN
cc_costume_description ON cc_costume_description.costume_id = cc_costumes.costume_id LEFT JOIN cc_users ON cc_users.id = cc_costumes.created_by";
        $products = DB::select(DB::Raw($query));
        $products = collect($products);

        return Datatables::of($products)
            ->editColumn('weight',function($products){
                return $products->weight.' lbs';
            })
            ->editColumn('cosplay',function($products){
                return ucfirst($products->cosplay);
            })
            ->editColumn('condition',function($products){
                if($products->condition == 'brand_new'){
                    return 'Brand New';
                }else if($products->condition == 'like_new'){
                    return 'Like New';
                }else if($products->condition == 'excellent'){
                    return 'Excellent';
                }else if($products->condition == 'good'){
                    return 'Good';
                }
            })
            ->editColumn('price',function($products){
            return '$'.number_format(floatval($products->price),2,'.','');
            })
            ->make(true);
    }

    public function searchProducts(Request $request){
        $req = $request->all();

        $query = "SELECT cc_costume_description.name, TRUNCATE( (weight_pounds + (weight_ounces/16)), 2) as weight, (SELECT GROUP_CONCAT(attribute_option_value SEPARATOR ' X ') FROM cc_costume_attribute_options WHERE cc_costume_attribute_options.costume_id = cc_costumes.costume_id and cc_costume_attribute_options.attribute_id IN (22,23,24) ) as dimensions, (SELECT attribute_option_value FROM cc_costume_attribute_options WHERE cc_costume_attribute_options.costume_id = cc_costumes.costume_id and cc_costume_attribute_options.attribute_id = 2) as cosplay, cc_costumes.condition, cc_costumes.created_at as created_at, cc_costumes.price, cc_users.display_name  FROM `cc_costumes`  LEFT JOIN
cc_costume_description ON cc_costume_description.costume_id = cc_costumes.costume_id LEFT JOIN cc_users ON cc_users.id = cc_costumes.created_by HAVING 1";

        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $fromDate = date('Y-m-d', strtotime($req['from_date']));
            $toDate = date('Y-m-d', strtotime($req['to_date']));
            $query .= " AND DATE(created_at) BETWEEN '" . $fromDate . "' AND '" . $toDate . "'";
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $fromDate = date('Y-m-d', strtotime($req['from_date']));
            $query .= " AND DATE(created_at) >= '".$fromDate."'";
        }

        if(isset($req['user_name']) && !empty($req['user_name'])){
            $query .= " AND display_name LIKE '%".$req['user_name']."%'";
        }

        if(isset($req['weight_from']) && !empty($req['weight_from']) && isset($req['weight_to']) && !empty($req['weight_to'])){
            $query .= " AND weight BETWEEN '" . $req['weight_from'] . "' AND '" . $req['weight_to'] . "'";
        }

        if(isset($req['cosplay']) && !empty($req['cosplay'])){
            $query .= " AND cosplay  = '".$req['cosplay']."'";
        }

        if(isset($req['condition']) && !empty($req['condition'])){
            $query .= " AND cc_costumes.condition  = '".$req['condition']."'";
        }

        $products = DB::select(DB::Raw($query));
        $products = collect($products);

        return Datatables::of($products)
            ->editColumn('weight',function($products){
                return $products->weight.' lbs';
            })
            ->editColumn('cosplay',function($products){
                return ucfirst($products->cosplay);
            })
            ->editColumn('condition',function($products){
                if($products->condition == 'brand_new'){
                    return 'Brand New';
                }else if($products->condition == 'like_new'){
                    return 'Like New';
                }else if($products->condition == 'excellent'){
                    return 'Excellent';
                }else if($products->condition == 'good'){
                    return 'Good';
                }
            })
            ->editColumn('price',function($products){
                return '$'.number_format(floatval($products->price),2,'.','');
            })
            ->make(true);
    }

    public function userReport(){
        return view('admin.reports.user_report');
    }

    public function getAllUsers(){
        $query = "SELECT cc_users.display_name, SUM(cc_order.total) as revenue, sum(cc_order_ship_track.amount)  as shipping_amnt, count(cc_order_ship_track.id) as total_prints  FROM cc_users LEFT JOIN cc_order ON cc_order.seller_id = cc_users.id LEFT JOIN cc_order_ship_track ON cc_order_ship_track.user_id = cc_order.seller_id GROUP BY cc_users.id HAVING  revenue > 0";
        $users = DB::select(DB::Raw($query));
        $users = collect($users);

        return Datatables::of($users)
            ->editColumn('revenue',function($users){
                return '$'.number_format(floatval($users->revenue),2,'.','');
            })
            ->editColumn('shipping_amnt',function($users){
                return '$'.number_format(floatval($users->shipping_amnt),2,'.','');
            })
            ->make(true);
    }

    public function searchUsers(Request $request){
        $req = $request->all();

        $query = "SELECT cc_users.display_name, SUM(cc_order.total) as revenue, sum(cc_order_ship_track.amount)  as shipping_amnt, count(cc_order_ship_track.id) as total_prints  FROM cc_users LEFT JOIN cc_order ON cc_order.seller_id = cc_users.id LEFT JOIN cc_order_ship_track ON cc_order_ship_track.user_id = cc_order.seller_id GROUP BY cc_users.id HAVING  revenue > 0";

        if(isset($req['revenue_range']) && !empty($req['revenue_range']) && $req['revenue_range'] != 500) {
            $range = explode('-', $req['revenue_range']);
            $query .= " AND revenue BETWEEN " . $range[0] . " AND " . $range[1] . "";
        }else if(isset($req['revenue_range']) && !empty($req['revenue_range']) && $req['revenue_range'] == 500){
            $query .= " AND revenue >= 500";
        }

        $users = DB::select(DB::Raw($query));
        $users = collect($users);

        return Datatables::of($users)
            ->editColumn('revenue',function($users){
                return '$'.number_format(floatval($users->revenue),2,'.','');
            })
            ->editColumn('shipping_amnt',function($users){
                return '$'.number_format(floatval($users->shipping_amnt),2,'.','');
            })
            ->make(true);
    }

    public function profileReport(){
        return view('admin.reports.profile_report');
    }

    public function getAllProfiles(){
        $query = "SELECT cc_users.display_name, count(cc_costumes.costume_id) as costumes, count(cc_order.order_id) as sales , cc_users.created_at as created_date, cc_address_master.zip_code as zip_code FROM cc_users LEFT JOIN cc_order ON cc_order.seller_id = cc_users.id LEFT JOIN cc_costumes ON cc_costumes.created_by = cc_users.id LEFT JOIN cc_address_master ON cc_address_master.user_id = cc_users.id GROUP BY cc_users.id HAVING costumes > 0";
        $profiles = DB::select(DB::Raw($query));
        $profiles = collect($profiles);

        return Datatables::of($profiles)
            ->editColumn('created_date',function($profiles){
                return date('m/d/y h:i:s A', strtotime($profiles->created_date));
            })
            ->make(true);
    }

    public function searchProfiles(Request $request){
        $req = $request->all();

        $query = "SELECT cc_users.display_name, count(cc_costumes.costume_id) as costumes, count(cc_order.order_id) as sales , cc_users.created_at as created_date, cc_address_master.zip_code as zip_code FROM cc_users LEFT JOIN cc_order ON cc_order.seller_id = cc_users.id LEFT JOIN cc_costumes ON cc_costumes.created_by = cc_users.id LEFT JOIN cc_address_master ON cc_address_master.user_id = cc_users.id GROUP BY cc_users.id HAVING costumes > 0";

        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $fromDate = date('Y-m-d', strtotime($req['from_date']));
            $toDate = date('Y-m-d', strtotime($req['to_date']));
            $query .= " AND DATE(created_date) BETWEEN '" . $fromDate . "' AND '" . $toDate . "'";
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $fromDate = date('Y-m-d', strtotime($req['from_date']));
            $query .= " AND DATE(created_date) >= '".$fromDate."'";
        }

        if(isset($req['user_name']) && !empty($req['user_name'])){
            $query .= " AND display_name LIKE '%".$req['user_name']."%'";
        }

        $profiles = DB::select(DB::Raw($query));
        $profiles = collect($profiles);

        return Datatables::of($profiles)
            ->editColumn('created_date',function($profiles){
                return date('m/d/y h:i:s A', strtotime($profiles->created_date));
            })
            ->make(true);
    }

    public function costReport(){
        return view('admin.reports.cost_report');
    }

    public function getAllCosts(){
        $query = "SELECT concat(cc_users.first_name,' ',cc_users.last_name) as display_name, (select sum(amount)  FROM cc_paypal_payouts WHERE cc_paypal_payouts.user_id = cc_users.id) as trans_amount, (SELECT sum(amount) from cc_order_charity WHERE cc_order_charity.user_id=cc_users.id) as charity_amnt, (SELECT count(cc_costumes.costume_id) as cnt FROM cc_costumes WHERE cc_costumes.created_by = cc_users.id) as costumes FROM cc_users GROUP BY cc_users.id HAVING 1";
        $costs = DB::select(DB::Raw($query));
        $costs = collect($costs);

        return Datatables::of($costs)
            ->editColumn('trans_amount',function($costs){
                return '$'.number_format(floatval($costs->trans_amount),2,'.','');
            })
            ->editColumn('charity_amnt',function($costs){
                return '$'.number_format(floatval($costs->charity_amnt),2,'.','');
            })
            ->make(true);
    }

    public function searchCosts(Request $request){
        $req = $request->all();

        $query = "SELECT concat(cc_users.first_name,' ',cc_users.last_name) as display_name, (select sum(amount)  FROM cc_paypal_payouts WHERE cc_paypal_payouts.user_id = cc_users.id) as trans_amount, (SELECT sum(amount) from cc_order_charity WHERE cc_order_charity.user_id=cc_users.id) as charity_amnt, (SELECT count(cc_costumes.costume_id) as cnt FROM cc_costumes WHERE cc_costumes.created_by = cc_users.id) as costumes FROM cc_users GROUP BY cc_users.id HAVING 1";

        if(isset($req['user_name']) && !empty($req['user_name'])){
            $query .= " AND display_name LIKE '%".$req['user_name']."%'";
        }

        $costs = DB::select(DB::Raw($query));
        $costs = collect($costs);

        return Datatables::of($costs)
            ->editColumn('trans_amount',function($costs){
                return '$'.number_format(floatval($costs->trans_amount),2,'.','');
            })
            ->editColumn('charity_amnt',function($costs){
                return '$'.number_format(floatval($costs->charity_amnt),2,'.','');
            })
            ->make(true);
    }

    public function requestBagReport(){
        return view('admin.reports.request_bag_report');
    }

    public function getAllRequestBags(){
        $request_bags = DB::table('request_bags')
            ->leftJoin('users','request_bags.user_id','=','users.id')
            ->leftJoin('address_master','request_bags.addres_id','=','address_master.address_id')
            ->leftJoin('request_shippings','request_shippings.request_id','=','request_bags.id')
            ->select('users.display_name as display_name','request_bags.created_at','address_master.zip_code as zip_code','request_bags.is_return as is_return','request_shippings.weight as weight')
            ->get();

        return Datatables::of($request_bags)
            ->editColumn('created_at',function($request_bags){
                return date('m/d/y h:i:s A', strtotime($request_bags->created_at));
            })
            ->editColumn('is_return',function($request_bags){
                $status = null;
                if($request_bags->is_return == 0){
                    $status = 'No';
                    return $status;
                }else if($request_bags->is_return == 1){
                    $status = 'Yes';
                    return $status;
                }
            })
            ->editColumn('weight',function($request_bags){
                return $request_bags->weight.' lbs';
            })
            ->make(true);
    }

    public function searchRequestBags(Request $request){
        $req = $request->all();

        $request_bags = DB::table('request_bags')
            ->leftJoin('users','request_bags.user_id','=','users.id')
            ->leftJoin('address_master','request_bags.addres_id','=','address_master.address_id')
            ->leftJoin('request_shippings','request_shippings.request_id','=','request_bags.id')
            ->select('users.display_name as display_name','request_bags.created_at','address_master.zip_code as zip_code','request_bags.is_return as is_return','request_shippings.weight as weight');

        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date= date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $request_bags->whereBetween('request_bags.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $request_bags->where('request_bags.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['user_name']) && !empty($req['user_name'])){
            $request_bags->having('display_name','LIKE','%'.$req['user_name'].'%');
        }
        if(isset($req['weight_from']) && !empty($req['weight_from']) && isset($req['weight_to']) && !empty($req['weight_to'])){
            $request_bags->whereBetween('weight', array($req['weight_from'], $req['weight_to']));
        }
        $requestBagData = $request_bags->get();

        return Datatables::of($requestBagData)
            ->editColumn('created_at',function($requestBagData){
                return date('m/d/y h:i:s A', strtotime($requestBagData->created_at));
            })
            ->editColumn('is_return',function($request_bags){
                $status = null;
                if($request_bags->is_return == 0){
                    $status = 'No';
                    return $status;
                }else if($request_bags->is_return == 1){
                    $status = 'Yes';
                    return $status;
                }
            })
            ->editColumn('weight',function($request_bags){
                return $request_bags->weight.' lbs';
            })
            ->make(true);
    }

    public function charityReport(){
        return view('admin.reports.charity_report');
    }

    public function getAllCharities(){

        $charities = DB::table('order_charity')
            ->leftJoin('users','order_charity.user_id','=','users.id')
            ->leftJoin('charities','order_charity.charity_id','=','charities.id')
            ->leftJoin('order','order_charity.order_id','=','order.order_id')
            ->select('charities.name as charity_name','users.display_name as user_name','order_charity.order_id as order_id','order_charity.amount as charity_amount','order.created_at as transaction_date')
            ->get();

        return Datatables::of($charities)
            ->editColumn('charity_amount',function($charities){
                return '$'.number_format(floatval($charities->charity_amount),2,'.','');
            })
            ->editColumn('transaction_date',function($charities){
                return date('m/d/y h:i:s A', strtotime($charities->transaction_date));
            })
            ->make(true);
    }

    public function searchCharities(Request $request){
        $req = $request->all();

        $charities = DB::table('order_charity')
            ->leftJoin('users','order_charity.user_id','=','users.id')
            ->leftJoin('charities','order_charity.charity_id','=','charities.id')
            ->leftJoin('order','order_charity.order_id','=','order.order_id')
            ->select('charities.name as charity_name','users.display_name as user_name','order_charity.order_id as order_id','order_charity.amount as charity_amount','order.created_at as transaction_date');

        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date= date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $charities->whereBetween('order.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $charities->where('order.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['charity_name']) && !empty($req['charity_name'])){
            $charities->having('charity_name','LIKE','%'.$req['charity_name'].'%');
        }
        if(isset($req['tran_amt_frm']) && !empty($req['tran_amt_frm'])){
            $charities->having('charity_amount','>=',$req['tran_amt_frm']);
        }
        if(isset($req['tran_amt_frm']) && !empty($req['tran_amt_frm']) && isset($req['tran_amt_to']) && !empty($req['tran_amt_to'])){
            $charities->whereBetween('charities.name', array($req['tran_amt_frm'], $req['tran_amt_to']));
        }
        $charityData = $charities->get();

        return Datatables::of($charityData)
            ->editColumn('charity_amount',function($charityData){
                return '$'.number_format(floatval($charityData->charity_amount),2,'.','');
            })
            ->editColumn('transaction_date',function($charities){
                return date('m/d/y h:i:s A', strtotime($charities->transaction_date));
            })
            ->make(true);
    }

    public function discountsReport(){
        return view('admin.reports.discount_report');
    }

    public function getAllDiscounts(){
        $discounts = DB::table('coupon_history')
            ->leftJoin('order','coupon_history.order_id','=','order.order_id')
            ->leftJoin('promotion_coupon','coupon_history.coupon_id','=','promotion_coupon.coupon_id')
            ->leftJoin('users','coupon_history.user_id','=','users.id')
            ->select('users.display_name as display_name','coupon_history.order_id as order_id','order.total as total','coupon_history.amount as discount','promotion_coupon.code as promo_code','promotion_coupon.type as type','order.created_at as created_at')
            ->get();

        return Datatables::of($discounts)
            ->editColumn('total',function($discounts){
                return '$'.number_format(floatval($discounts->total),2,'.','');
            })
            ->editColumn('discount',function($discounts){
                return '$'.number_format(floatval($discounts->discount),2,'.','');
            })
            ->editColumn('type',function($discounts){
                return ucfirst($discounts->type);
            })
            ->editColumn('created_at',function($discounts){
                return date('m/d/y h:i:s A', strtotime($discounts->created_at));
            })
            ->make(true);
    }

    public function searchDiscounts(Request $request){
        $req = $request->all();

        $discounts = DB::table('coupon_history')
            ->leftJoin('order','coupon_history.order_id','=','order.order_id')
            ->leftJoin('promotion_coupon','coupon_history.coupon_id','=','promotion_coupon.coupon_id')
            ->leftJoin('users','coupon_history.user_id','=','users.id')
            ->select('users.display_name as display_name','coupon_history.order_id as order_id','order.total as total','coupon_history.amount as discount','promotion_coupon.code as promo_code','promotion_coupon.type as type','order.created_at as created_at');

        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date= date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $discounts->whereBetween('order.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $discounts->where('order.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['dis_amt_frm']) && !empty($req['dis_amt_frm']) && isset($req['dis_amt_to']) && !empty($req['dis_amt_to'])){
            $discounts->whereBetween('coupon_history.amount', array($req['dis_amt_frm'], $req['dis_amt_to']));
        }
        if(isset($req['tran_amt_frm']) && !empty($req['tran_amt_frm']) && isset($req['tran_amt_to']) && !empty($req['tran_amt_to'])){
            $discounts->whereBetween('order.total', array($req['tran_amt_frm'], $req['tran_amt_to']));
        }
        if(isset($req['promo_code']) && !empty($req['promo_code'])){
            $discounts->having('promo_code','LIKE','%'.$req['promo_code'].'%');
        }
        $discountData = $discounts->get();

        return Datatables::of($discountData)
            ->editColumn('total',function($discounts){
                return '$'.number_format(floatval($discounts->total),2,'.','');
            })
            ->editColumn('discount',function($discounts){
                return '$'.number_format(floatval($discounts->discount),2,'.','');
            })
            ->editColumn('type',function($discounts){
                return ucfirst($discounts->type);
            })
            ->editColumn('created_at',function($discounts){
                return date('m/d/y h:i:s A', strtotime($discounts->created_at));
            })
            ->make(true);
    }

    
    public static function getStatusChange()
    {
        $get_batch_id = DB::table('payout_log')->where('batch_status', 'PENDING')->get();
        foreach ($get_batch_id as $key => $batch_id) {
            $get_status = PayPalPayout::getPayoutStatus($batch_id->payout_batch_id);
            if($get_status['status'] == 1){
                $output = $get_status['output'];
                //if($value->id == $batch_id->type_id){
                    if ($output->batch_header->batch_status == "SUCCESS") {
                        $get_details = DB::table('paypal_payouts')->where('user_id',$batch_id->user_id)->update(['status'=>'paid']);

                        $updateLog = DB::table('payout_log')
                                ->where('id',$batch_id->id)
                                ->update(['note'=> json_encode($get_status['output']), 'batch_status'=>'SUCCESS', 'updated_at'=>date('y-m-d H:i:s')]);
                    }
                //}
            }
            else{
                $updateLog = DB::table('payout_log')
                                ->where('id',$batch_id->id)
                                ->update(['note'=> json_encode($get_status['output']), 'batch_status'=>'FAILED', 'updated_at'=>date('y-m-d H:i:s')]);
            }
        }

        /*$payouts = DB::table('paypal_payouts')->get();
        foreach ($payouts as $key => $value) {
            if($value->status == 'pending'){
                $get_batch_id = DB::table('payout_log')->where('batch_status', 'PENDING')->get();
                foreach ($get_batch_id as $key => $batch_id) {
                    $get_status = PayPalPayout::getPayoutStatus($batch_id->payout_batch_id);
                    if($get_status['status'] == 1){
                        $output = $get_status['output'];
                        if($value->id == $batch_id->type_id){
                            if ($output->batch_header->batch_status == "SUCCESS") {
                                $get_details = DB::table('paypal_payouts')->where('user_id',$batch_id->user_id)->update(['status'=>'paid']);

                                $updateLog = DB::table('payout_log')
                                        ->where('id',$batch_id->id)
                                        ->update(['note'=> json_encode($get_status['output']), 'batch_status'=>'SUCCESS', 'updated_at'=>date('y-m-d H:i:s')]);
                            }
                        }
                    }
                    else{
                        $updateLog = DB::table('payout_log')
                                        ->where('id',$batch_id->id)
                                        ->update(['note'=> json_encode($get_status['output']), 'batch_status'=>'FAILED', 'updated_at'=>date('y-m-d H:i:s')]);
                    }
                }
            }
        }*/
        
    }
}

