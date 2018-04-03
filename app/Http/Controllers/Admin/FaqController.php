<?php
namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
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
use Validator;
use App\Helpers\Site_model;

class FaqController extends Controller  {

    public function index(){
        return view('admin.faq.index');
    }

    public function addFaqs(){
        return view('admin.faq.addfaq');
    }

    public function getAllFaqs(){
        $faqs = DB::table('faqs')->get();
        return Datatables::of($faqs)
            ->addColumn('actions', function ($faqs) {
                return '<a href="/edit-faq/'.$faqs->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void(0);" onclick="deleteFaq('.$faqs->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->editColumn('created',function($faqs){
                return date('m/d/y h:i:s A', strtotime($faqs->created_at));
            })
            ->editColumn('block', function ($faqs) {
                if($faqs->block == 'how-it-works'){
                    return 'How It Works';
                }else if($faqs->block == 'support-and-contact'){
                    return 'Support And Contact';
                }else if($faqs->block == 'sell-a-costume'){
                    return 'Sell A Costume';
                }
            })
            ->editColumn('status', function ($faqs) {
                $a = $faqs->status == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $faqs->id .'" onClick="changeFaqStatus('.$faqs->id.','.$faqs->status.');">
                                   <div class="slider round"></div>
                               </label>';
            })->make(true);
    }

    public function store(Request $request){
        $req = $request->all();

        if (count($req)) {
            $rule = array(
                'title'  => 'required|max:1024',
                'block'    => 'required|max:160',
                'faq_description'  => 'required',
                'sort_no'  => 'required',
            );

            $validator = Validator::make($req, $rule);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->messages())->withInput();
            } else {
                $faqStatus = 1;

                $data = array(
                    'title'      => $req['title'],
                    'block'      => $req['block'],
                    'description'        => $req['faq_description'],
                    'sort_no'        => $req['sort_no'],
                    'status' => $faqStatus,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $faqData = Site_model::insert_data('faqs', $data);
                Session::flash('success', 'FAQ added successfully');
                return Redirect::to('manage-faqs');

            }
        }
        Session::flash('error', 'Sorry your CMS block could no be saved. Pls try again later.');
        return view('admin.cms.add-cms-block');
    }

    public function edit($id){
        $faq = DB::table('faqs')->where('faqs.id',$id)->first();
        return view('admin.faq.edit')->with('faq',$faq);
    }

    public function update(Request $request,$id){
        $req = $request->all();
        if (count($req)) {
            $rule = array(
                'title'  => 'required|max:1024',
                'block'    => 'required|max:160',
                'faq_description'  => 'required',
                'sort_no'  => 'required',
            );

            $validator = Validator::make($req, $rule);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->messages())->withInput();
            } else {

                $faqData = array(
                    'title'      => $req['title'],
                    'block'      => $req['block'],
                    'description'        => $req['faq_description'],
                    'sort_no'        => $req['sort_no'],
                    'status' => $req['status'],
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $condition = array('id' => $id);
                $updateFaqData = Site_model::update_data('faqs', $faqData, $condition);
                if($updateFaqData){
                    Session::flash('success', 'FAQ updated successfully.');
                    return Redirect::to('manage-faqs');
                }

            }

        }
        Session::flash('error', 'FAQ cannot be updated, Pls try again. Pls try again.');
        return view('manage-faqs');
    }

    public function delete($id){
        $condition = array('id' => $id);
        $delete    = Site_model::delete_single('faqs', $condition);
        if ($delete) {
            Session::flash('success', 'FAQ has been deleted successfully.');
        } else {
            Session::flash('fail', 'Unable To delete this FAQ. Pls try again.');
        }

        return redirect('manage-faqs');
    }

    public function faqSearch(Request $request){
        $req = $request->all();

        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }

        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date = date("Y-m-d 23:59:59",$timestamp);
        }

        $faqs = DB::table('faqs');
        if(isset($req['title']) && !empty($req['title'])){
            $faqs->where('faqs.title','LIKE','%'.$req['title'].'%');
        }
        if(isset($req['block']) && !empty($req['block'])){
            $faqs->where('faqs.block','=',$req['block']);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date']) ) {
            $faqs->whereBetween('faqs.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $faqs->where('faqs.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(!empty($req['status'])){
            if($req['status'] == 'enabled'){
                $req['status'] == 1;
            }else if($req['status'] == 'disabled'){
                $req['status'] == 0;
            }
            $faqs->where('faqs.status','=',$req['status']);
        }

        return Datatables::of($faqs)
            ->addColumn('actions', function ($faqs) {
                return '<a href="/edit-faq/'.$faqs->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void(0);" onclick="deleteFaq('.$faqs->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->editColumn('created',function($faqs){
                return date('m/d/y h:i:s A', strtotime($faqs->created_at));
            })
            ->editColumn('block', function ($faqs) {
                if($faqs->block == 'how-it-works'){
                    return 'How It Works';
                }else if($faqs->block == 'support-and-contact'){
                    return 'Support And Contact';
                }else if($faqs->block == 'sell-a-costume'){
                    return 'Sell A Costume';
                }
            })
            ->editColumn('status', function ($faqs) {
                $a = $faqs->status == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $faqs->id .'" onClick="changeFaqStatus('.$faqs->id.','.$faqs->status.');">
                                   <div class="slider round"></div>
                               </label>';
            })->make(true);
    }

    public function changeFaqSatus(Request $request){
        $id     = $request->input('id');
        $getFaq = DB::table('faqs')->where('id', $id)->first(['status']);
        if ($getFaq->status == 1) {
            $faq = DB::table('faqs')->where('id', $id)->update(['status' => 0]);
        }else{
            $faq = DB::table('faqs')->where('id', $id)->update(['status' => 1]);
        }

        return $faq;
    }

}
