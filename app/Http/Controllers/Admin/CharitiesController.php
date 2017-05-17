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
use Hash;
use Response;
use Validator;
use App\Charities;
use App\Helpers\Site_model;
use App\Helpers\ExportFile;

class CharitiesController extends Controller
{
    protected $messageBag = null;
    

    public function __construct()
    {
       $this->csv = new ExportFile();
       $this->middleware(function ($request, $next) {
          if(!Auth::check()){
            return Redirect::to('/admin/login')->send();
          }
          else{
               return $next($request);
          }
      });
    }
   public function charitiesList()
   {
      return view('admin.charities.charities_list');
   }
   public function charitiesData(Request $request)
   {
        $req=$request->all();
        $where='where 1';
        if(!empty($req['search'])){
          if(!empty($req['search']['name']) ){
            $where.=' AND cht.name LIKE "%'.$req['search']['name'].'%"';
          }
          if(!empty($req['search']['from_date']) ){
            $where.=' AND  cht.created_at >="'.date('Y-m-d 00:00:01',strtotime($req['search']['from_date'])).'"';
          }
          if(!empty($req['search']['date_end']) ){
              $where.=' AND cht.created_at  <= "'.date('Y-m-d 23:59:59',strtotime($req['search']['date_end'])).'"';
          }
           if(isset($req['search']['status'])){
            if($req['search']['status']==""){
              $where.=' AND  cht.status in("0","1")';
            }
            if($req['search']['status']!=""){
              $where.=' AND cht.status="'.$req['search']['status'].'"';
            }
          }
        }
        $charities = DB::select('SELECT cht.id,cht.name,cht.image,cht.status,if(usr.role_id!="1",usr.display_name,"") as user_name,DATE_FORMAT(cht.created_at,"%m/%d/%Y %h:%i %p") as date FROM cc_charities as cht LEFT JOIN cc_users as usr on cht.suggested_by=usr.id '.$where.'');
        return response()->success(compact('charities'));
   }
   public function charitiesCsvExport(Request $request){
     $req = $request->all();
        $result = DB::select('SELECT cht.id,cht.name,if(cht.status="1","Active","Inactive") as Status,if(usr.role_id!="1",usr.display_name,"") as user_name,DATE_FORMAT(cht.created_at,"%m/%d/%Y %h:%i %p") as Date FROM cc_charities as cht LEFT JOIN cc_users as usr on cht.suggested_by=usr.id');
        $data = json_decode(json_encode($result), true);
        $this->csv->csvExportFile($data);
  }
   public function createCharity(Request $request)
   {
         $req=$request->all();
         $rule  = array('name' => 'required|max:50',
                        'image' => 'required',
                        );
         $validator = Validator::make($req,$rule);
         if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
         else
            { 
                  Charities::createCharities($req,Auth::user()->id);
                  Session::flash('success', 'Charity is created successfully');
                  return Redirect::back();
            }
   }
   public function editCharity(Request $request)
   {
         $req=$request->all();
         $rule  = array('charity_name' => 'required|max:50',
                        );
         $validator = Validator::make($req,$rule);
         if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
         else
            { 
                  Charities::updateCharities($req);
                  Session::flash('success', 'Charity is updated successfully');
                  return Redirect::back();
            }
   }
   public function deleteCharity($id)
   {   
         $cond = array('id'=>$id);
         Site_model::delete_single('charities',$cond);
         Session::flash('success', 'Charity is deleted successfully');
         return Redirect::back();
   }
 public function changeCharityStatus(Request $request)
  {
    $req = $request->all(); 
    $res=Charities::changeCharityStatus($req);
    return Response::JSON($res);
  }

}
