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

class RequestabagController extends Controller
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
	Method Name : manageBag()
	Purpose :
	*/
	public function manageBag(){
	   return view('admin.request-a-bag.managebag');
	}

	/*
	Method Name : processBag()()
	Purpose :
	*/
	public function processBag($id){
		$this->data = array();
		$this->data['request_a_bag'] = DB::table('request_bags')->where('id',$id)
		->leftJoin('address_master','request_bags.addres_id','address_master.address_id')->first();
		$generated_lables = DB::table('request_shippings')->where('request_id',$id)->get();
		$count_generated_lable =  count($generated_lables);
		$this->data['generated_lables_html'] = '0';
		if ($count_generated_lable != 0) {
		
			$html = '<div>';
			foreach ($generated_lables as $label_html) {
				if ($label_html->type == 'pick') {
					$html .= '<p>Empty Bag Tracking Number: <a>UX'.$label_html->shipping_no.'</a> <i> via USPS generated '.$label_html->created_at.' </i> </p> ';
				}else if($label_html->type == 'drop'){
					$html .= '<p>Customer Tracking Number: <a>UX'.$label_html->shipping_no.'</a> <i> via USPS generated '.$label_html->created_at.'</i> </p>';
				}				
			}
			$html .= '</div>';
		$this->data['generated_lables_html'] = $html;
		}
		$payout_details = DB::table('request_credits')->where('request_id',$id)->where('type','payout')->first();
		$count_payout = count($payout_details);
		$this->data['payout_html'] = "0";
		if ($count_payout != 0 ) {
			$html = '<p> Payout Amount Credited $ '.$payout_details->credit.' </p>';
			$this->data['payout_html'] = $html;
		}
		$return_details = DB::table('request_credits')->where('request_id',$id)->where('type','return')->first();
		$count_return = count($return_details);
		$this->data['return_html'] = "0";
		if ($count_return != 0 ) {
			$html = '<p> Return initiated $ '.$return_details->credit.' </p>';
			$this->data['return_html'] = $html;
		}
	   return view('admin.request-a-bag.processabag')->with('total_data',$this->data);
	}
	public function Getallmanagebags(){
		$request_bags=DB::table('request_bags')->get();
	return Datatables::of($request_bags)
        ->addColumn('actions', function ($request_bagso) {
                return '<a href="/process-bag/'.$request_bagso->id.'" class="btn btn-xs  btn-warning" data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
            })
        ->make(true);
	}
	public function Generatelables(Request $request){
		$this->data = array();
		$random_drop = str_random(13);
		$random_pick = str_random(13);
		$shipping_array_pick = array('request_id'=>$request->id,
			'type'=>'pick',
			'weight'=>'',
			'shipping_no'=>$random_pick,
			'created_at'=>date('y-m-d H:i:s'),
			);
		$shpippin_pick_insert = DB::table('request_shippings')->insertGetId($shipping_array_pick);
		$shipping_array_drop = array('request_id'=>$request->id,
			'type'=>'drop',
			'weight'=>'',
			'shipping_no'=>$random_drop,
			'created_at'=>date('y-m-d H:i:s'),
			);
		$shpippin_drop_insert = DB::table('request_shippings')->insertGetId($shipping_array_drop);
		$status_update = DB::table('request_bags')->where('id',$request->id)->update(['status'=>'shipped']);
		//echo "<pre>";print_r($shpippin_drop_insert);die;
		
		$html = '<div>		<p>Empty Bag Tracking Number: <a>UX'.$random_pick.'</a> <i>via USPS generated '.date('y-m-d H:i:s').'</i></p>
							<p>Empty Bag Tracking Number: <a>UX'.$random_drop.'</a> <i>via USPS generated '.date('y-m-d H:i:s').'</i></p>
						</div>';
		$this->data['html'] = $html;
		$this->data['status'] = "Shipped";
		return $this->data;
	}
	public function Payoutamount(Request $request){
		//echo "<pre>"; print_r($request->payout_amount);die;
		$this->data = array();
		$get_user_id = DB::table('request_bags')->where('id',$request->request_id)->first(['user_id']);
		$payout_amount_array = array('user_id'=>$get_user_id->user_id,
			'request_id'=>$request->request_id,
			'type'=>'payout',
			'credit'=>$request->payout_amount,
			'created_at'=>date('y-m-d H:i:s'),);
		$payout_amount_insert = DB::table('request_credits')->insertGetId($payout_amount_array);
		$status_update = DB::table('request_bags')->where('id',$request->request_id)->update(['status'=>'paid']);
		$html = '<p> Payout Amount Credited $ '.$request->payout_amount.' </p>';
		$this->data['html'] = $html;
		$this->data['status'] = "Payout Amount Credited.";
		return $this->data;
	}
	public function Returnamount(Request $request){
		//echo "<pre>"; print_r($request->all());die;
		$this->data = array();
		$get_user_id = DB::table('request_bags')->where('id',$request->request_id)->first(['user_id']);
		$get_credit_amount = DB::table('request_credits')->where('request_id',$request->request_id)->where('user_id',$get_user_id->user_id)->where('type','payout')->first();
		if (count($get_credit_amount) == 0) {
			$this->data['html'] = "<p> No Credit Amount.</p>";
			return $this->data;
		}
		$total = $request->return_amount;
		if ($request->checkbox_value == 0) {
			$total = $request->return_amount-9.99;
		}
		$return_amount_array = array('user_id'=>$get_user_id->user_id,
			'request_id'=>$request->request_id,
			'type'=>'return',
			'credit'=>$request->return_amount,
			'created_at'=>date('y-m-d H:i:s'),);
		$return_amount_insert = DB::table('request_credits')->insertGetId($return_amount_array);
		/*$update_amount = DB::table('request_credits')->where('request_id',$request->request_id)->where('user_id',$get_user_id->user_id)->where('type','return')->update(['credit'=>$total]);*/
		$status_update = DB::table('request_bags')->where('user_id',$get_user_id->user_id)->where('id',$request->request_id)->update(['status'=>'return']);
		$html = '<p> Return initiated $ '.$total.' </p>';
		$this->data['html'] = $html;
		$this->data['status'] = "Return initiated.";
		return $this->data;
	}

	public function Closerequest(Request $request){
		//echo "<pre>";print_r($request->all());die;
		$this->data = array();
		$get_user_id = DB::table('request_bags')->where('id',$request->request_id)->first(['user_id']);
		$status_update = DB::table('request_bags')->where('user_id',$get_user_id->user_id)->where('id',$request->request_id)->update(['status'=>'closed']);
		$this->data['status'] = "Request Closed";
		return $this->data;
	}
}