<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Order;
use App\Transactions;
use App\Helpers\ExportFile;
use Session;


class TransactionsController extends Controller {
    
    public function __construct(Guard $auth)
    {
          $this->csv = new ExportFile();
          $this->middleware(function ($request, $next) {
              if(!Auth::check()){
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        });

    }
    public function transactionsList()
    {
      $title="Transactions List";
      return view('admin.transactions.transactions_list')->with('title',$title);
    }
     public function transactionsListData(Request $request)
    {
        $req=$request->all();
        $where='where 1';
        $having='';
        if(!empty($req['search'])){
          if(!empty($req['search']['order_id']) ){
            $where.=' AND trans.order_id ="'.$req['search']['order_id'].'"';
          }
          if(!empty($req['search']['id']) ){
            $where.=' AND trans.id ="'.$req['search']['id'].'"';
          }
          if(!empty($req['search']['user_name']) ){
            $where.=' AND concat(usr.first_name," ",usr.last_name) LIKE "%'.$req['search']['user_name'].'%"';
          }
          if (!empty($req['search']['from_date'])) {
            $where .= ' AND  trans.created_at >="'.date('Y-m-d 00:00:01', strtotime($req['search']['from_date'])).'"';
          }
          if (!empty($req['search']['date_end'])) {
            $where .= ' AND  trans.created_at  <= "'.date('Y-m-d 23:59:59', strtotime($req['search']['date_end'])).'"';
          }
          if(isset($req['search']['status'])){
          if($req['search']['status']!=""){
              $where.=' AND trans.status LIKE "%'.$req['search']['status'].'%"';
          }
        }
        }
        $transactions = DB::select('SELECT trans.id as transaction_id,trans.order_id,concat(usr.first_name," ",usr.last_name) as user_name,concat("$ ",trans.amount) as price,DATE_FORMAT(trans.created_at,"%m/%d/%Y %h:%i %p") as date,CONCAT(UCASE(LEFT(trans.status, 1)), SUBSTRING(trans.status, 2)) as status FROM cc_transactions as trans  LEFT JOIN cc_users as usr on usr.id=trans.user_id '.$where.' GROUP BY trans.id  ORDER BY trans.id DESC');
        return response()->success(compact('transactions'));
  
    }
    public function transactionView($tansaction_id)
    {
      $title="Transactions View";
      $transaction_info=Transactions::getTransactionInformation($tansaction_id);
      if(count($transaction_info)){
        return view('admin.transactions.transaction_view',compact('transaction_info',$transaction_info))->with('title',$title);
      }else{
        Session::flash('error', 'Transaction information not found.'); 
        return Redirect::to('/transactions'); 
      }
      
    }
    public function transactionsCsvExport(Request $request){
       $req = $request->all();
       if(!empty($req['data'])){
         $ids=implode($req['data'],",");
       $result = DB::select('SELECT trans.id as transaction_id,trans.order_id,concat(usr.first_name," ",usr.last_name) as user_name,concat("$ ",trans.amount) as price,DATE_FORMAT(trans.created_at,"%m/%d/%Y %h:%i %p") as date,CONCAT(UCASE(LEFT(trans.status, 1)), SUBSTRING(trans.status, 2)) as status FROM cc_transactions as trans  LEFT JOIN cc_users as usr on usr.id=trans.user_id where trans.id in ('.$ids.')');
       $data = json_decode(json_encode($result), true);
      $this->csv->csvExportFile($data);
    }
    else{
       $result = DB::select('SELECT trans.id as transaction_id,trans.order_id,concat(usr.first_name," ",usr.last_name) as user_name,concat("$ ",trans.amount) as price,DATE_FORMAT(trans.created_at,"%m/%d/%Y %h:%i %p") as date,CONCAT(UCASE(LEFT(trans.status, 1)), SUBSTRING(trans.status, 2)) as status FROM cc_transactions as trans  LEFT JOIN cc_users as usr on usr.id=trans.user_id');
       $data = json_decode(json_encode($result), true);
       $this->csv->csvExportFile($data);
    }
  }

   
}