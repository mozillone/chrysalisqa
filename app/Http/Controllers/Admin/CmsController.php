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
use CmsPages;

class CmsController extends Controller  {

	public function addCmsPage() {
		return view('admin.cms.add-cms-page');
	}

	public function store(Request $request){
		$req = $request->all();

		if (count($req)) {
			$rule = array(
				'title'  => 'required|max:60',
				'url'    => 'required',
				'description'  => 'required',
				'meta_title'   => 'required|max:60',
				'meta_desc' => 'required',
			);

			$validator = Validator::make($req, $rule);

			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator->messages())->withInput();
			} else {
			    $pageStatus = 1;

				$data = array(
					'title'      => $req['title'],
					'url'      => url('/'.$req['url']),
					'description'        => $req['description'],
					'meta_title'    => $req['meta_title'],
					'meta_desc' => $req['meta_desc'],
					'status' => $pageStatus,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				);
				$user_meta = Site_model::insert_data('cms_pages', $data);
				Session::flash('success', 'CMS page added successfully.');
				return Redirect::to('cms-pages');

			}
		}
		Session::flash('error', 'Sorry your page could no be saved. Pls try again later.');
		return view('admin.cms.add-cms-page');
	}

	public function getAllPages(){
        $pages = \App\CmsPages::all();
        return Datatables::of($pages)
            ->addColumn('actions', function ($pages) {
                return '<a href="edit-page/'.$pages->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                <a href="javascript:void(0);" onclick="deletePage('.$pages->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a>';
            })
            ->editColumn('created',function($pages){
                return date('dS M Y, h:i:s A', strtotime($pages->created_at));
            })
            ->editColumn('status', function ($pages) {
                $a = $pages->status == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $pages->id .'" onClick="changePageStatus('.$pages->id.','.$pages->status.');">
                                   <div class="slider round"></div>
                               </label>';
            })->make(true);
    }

    public function cmsPages() {
		return view('admin.cms.cms-pages');
	}

	public function cmsBlocks() {
		return view('admin.cms.cms-blocks');
	}

	public function addCmsBlock() {
		return view('admin.cms.add-cms-block');
	}

    public function destroy($id) {
        $condition = array('id' => $id);
        $delete    = Site_model::delete_single('cms_pages', $condition);
        if ($delete) {
            Session::flash('success', 'CMS page has been deleted successfully.');
        } else {
            Session::flash('fail', 'Unable To delete this CMS page. Pls try again.');
        }

        return redirect('cms-pages');
    }

    public function edit($id) {
        $page = \App\CmsPages::find($id);
        return view('admin.cms.edit-cms-page',compact('page'));
    }

    public function update($id, Request $request){
        $req = $request->all();

        if (count($req)) {
            $rule = array(
                'title'  => 'required|max:60',
                'url'    => 'required',
                'description'  => 'required',
                'meta_title'   => 'required|max:60',
                'meta_desc' => 'required',
                'status' => 'required'
            );

            $validator = Validator::make($req, $rule);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->messages())->withInput();
            } else {

                $data = array(
                    'title'      => $req['title'],
                    'url'      => $req['url'],
                    'description'        => $req['description'],
                    'meta_title'    => $req['meta_title'],
                    'meta_desc' => $req['meta_desc'],
                    'status' => $req['status'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $condition = array('id' => $id);
                $user_meta = Site_model::update_data('cms_pages', $data, $condition);
                Session::flash('success', 'CMS page updated successfully.');
                return Redirect::to('cms-pages');

            }

        }
        Session::flash('success', 'Cms Content not uploaded sucessfully.');
        return view('admin.cms.create');
    }

    public function changePageStatus(Request $request) {
        $status = $request->input('status');
        $id     = $request->input('id');
        $getPage = DB::table('cms_pages')->where('id', $id)->first(['status']);
        if ($getPage->status == 1) {
            $page = DB::table('cms_pages')->where('id', $id)->update(['status' => 0]);
        }else{
            $page  = DB::table('cms_pages')->where('id', $id)->update(['status' => 1]);
        }

        return $page;
    }

    public function pageSearch(Request $request){
        $req = $request->all();

        list($m,$d,$y) = explode("-",$req['to_date']);
        $timestamp = mktime(0,0,0,$m,$d,$y);
        $to_date = date("Y-m-d 23:59:59",$timestamp);

        $pages = DB::table('cms_pages');
        if(!empty($req['title'])){
            $pages->where('cms_pages.title','LIKE','%'.$req['title'].'%');
        }
        if(!empty($req['from_date'])) {
            $pages->whereBetween('cms_pages.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }
        if(!empty($req['status'])){
            $pages->where('cms_pages.status','=',$req['status']);
        }

        return Datatables::of($pages)
            ->addColumn('actions', function ($pages) {
                return '<a href="edit-page/'.$pages->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                <a href="javascript:void(0);" onclick="deletePage('.$pages->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a>';
            })
            ->editColumn('created',function($pages){
                return date('dS M Y, h:i:s A', strtotime($pages->created_at));
            })
            ->editColumn('status', function ($pages) {
                $a = $pages->status == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $pages->id .'" onClick="changePageStatus('.$pages->id.','.$pages->status.');">
                                   <div class="slider round"></div>
                               </label>';
            })->make(true);

    }

    public function checkUrlAvailability(Request $request){
        if($request->isMethod('get')){
            $req = $request->all();
            if(!empty($req)){
                $requestUrl = url('/'.$req['url']);
                $url = DB::table('cms_pages')->where('url',$requestUrl)->get();
                return count($url);
            }
        }
    }

}
