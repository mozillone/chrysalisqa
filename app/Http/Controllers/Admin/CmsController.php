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
				'url'    => 'unique:cms_pages,url|required',
				'page_desc'  => 'required',
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
					'url'      => $req['url'],
					'description'        => $req['page_desc'],
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
                return '<a href="/edit-page/'.$pages->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>';
            })
            ->editColumn('created',function($pages){
                return date('m/d/y h:i:s A', strtotime($pages->created_at));
            })
            ->editColumn('url',function($pages){
                $slug = url('/pages/'.$pages->url);
                $url = "<a href=".$slug." target='_blank'>$slug</a>";
                return $url;
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
	    $pagesData = array(
	        'about-us'=>'About Us',
            'how-it-works'=>'How It Works',
            'jobs'=>'Jobs',
            'giving-back'=>'Giving Back',
            'home'=>'Home',
            'header'=>'Header',
            'sell-a-costume'=>'Sell A Costume',
            'search'=>'Search Banner Image'
        );
		return view('admin.cms.add-cms-block')->with('pagesData',$pagesData);
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
                'page_desc'  => 'required',
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
                    'description'        => $req['page_desc'],
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

        $pages = DB::table('cms_pages');
        if(isset($req['title']) && !empty($req['title'])){
            $pages->where('cms_pages.title','LIKE','%'.$req['title'].'%');
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $pages->whereBetween('cms_pages.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $pages->where('cms_pages.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['status']) && !empty($req['status'])){
            if($req['status'] == 'enabled'){
                $req['status'] = 1;
            }else if($req['status'] == 'disabled'){
                $req['status'] = 0;
            }
            $pages->where('cms_pages.status','=',$req['status']);
        }

        return Datatables::of($pages)
            ->addColumn('actions', function ($pages) {
                return '<a href="/edit-page/'.$pages->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>';
            })
            ->editColumn('created',function($pages){
                return date('m/d/y h:i:s A', strtotime($pages->created_at));
            })
            ->editColumn('url',function($pages){
                $slug = url('/pages/'.$pages->url);
                $url = "<a href=".$slug." target='_blank'>$slug</a>";
                return $url;
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

    public function getAllBlocks(){
        $cmsBlocks = DB::table('cms_blocks')->select('*')->get();
        return Datatables::of($cmsBlocks)
            ->addColumn('actions', function ($cmsBlocks) {
                return '<a href="/edit-block/'.$cmsBlocks->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>';
            })
            ->editColumn('created',function($cmsBlocks){
                return date('m/d/y h:i:s A', strtotime($cmsBlocks->created_at));
            })
            ->editColumn('status', function ($cmsBlocks) {
                $a = $cmsBlocks->status == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $cmsBlocks->id .'" onClick="changeBlockStatus('.$cmsBlocks->id.','.$cmsBlocks->status.');">
                                   <div class="slider round"></div>
                               </label>';
            })->make(true);
    }

    public function storeCmsBlock(Request $request){
        $req = $request->all();

        if (count($req)) {
            $rule = array(
                'title'  => 'required|max:160',
                'slug'    => 'unique:cms_blocks,slug|required',
                'description'  => 'required',
            );

            $validator = Validator::make($req, $rule);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->messages())->withInput();
            } else {
                $blockStatus = 1;

                $data = array(
                    'title'      => $req['title'],
                    'slug'      => $req['slug'],
                    'description'        => $req['description'],
                    'status' => $blockStatus,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $blockData = Site_model::insert_data('cms_blocks', $data);
                Session::flash('success', 'CMS block added successfully.');
                return Redirect::to('cms-blocks');

            }
        }
        Session::flash('error', 'Sorry your CMS block could no be saved. Pls try again later.');
        return view('admin.cms.add-cms-block');
    }

    public function editBlock($id) {
        $cmsBlock = DB::table('cms_blocks')->where('id',$id)->first();
        $pagesData = array(
            'about-us'=>'About Us',
            'how-it-works'=>'How It Works',
            'jobs'=>'Jobs',
            'giving-back'=>'Giving Back',
            'home'=>'Home',
            'header'=>'Header',
            'sell-a-costume'=>'Sell A Costume',
            'search'=>'Search Banner Image'
        );
        return view('admin.cms.edit-cms-block',compact('cmsBlock','pagesData'));
    }

    public function updateCmsBlock(Request $request, $id){
        $req = $request->all();

        if (count($req)) {
            $rule = array(
                'title'  => 'required|max:160',
                'slug'    => 'required',
                'description'  => 'required'
            );

            $validator = Validator::make($req, $rule);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->messages())->withInput();
            } else {
                $blockStatus = 1;
                $data = array(
                    'title'      => $req['title'],
                    'slug'      => $req['slug'],
                    'description'        => $req['description'],
                    'status' => $blockStatus,
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $condition = array('id' => $id);
                $user_meta = Site_model::update_data('cms_blocks', $data, $condition);
                Session::flash('success', 'CMS block updated successfully.');
                return Redirect::to('cms-blocks');

            }

        }
        Session::flash('success', 'Cms block cannot be updated. Pls try again.');
        return Redirect::to('cms-blocks');
    }

    public function changeBlockStatus(Request $request) {
        $id     = $request->input('id');
        $getBlock = DB::table('cms_blocks')->where('id', $id)->first(['status']);
        if ($getBlock->status == 1) {
            $block = DB::table('cms_blocks')->where('id', $id)->update(['status' => 0]);
        }else{
            $block = DB::table('cms_blocks')->where('id', $id)->update(['status' => 1]);
        }

        return $block;
    }

    public function blockSearch(Request $request){
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

        $blocks = DB::table('cms_blocks');
        if(isset($req['title']) && !empty($req['title'])){
            $blocks->where('cms_blocks.title','LIKE','%'.$req['title'].'%');
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $blocks->whereBetween('cms_blocks.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $blocks->where('cms_blocks.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['status']) && !empty($req['status'])){
            if($req['status'] == 'enabled'){
                $req['status'] = 1;
            }else if($req['status'] == 'disabled'){
                $req['status'] = 0;
            }
            $blocks->where('cms_blocks.status','=',$req['status']);
        }

        return Datatables::of($blocks)
            ->addColumn('actions', function ($blocks) {
                return '<a href="/edit-block/'.$blocks->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>';
            })
            ->editColumn('created',function($blocks){
                return date('m/d/y h:i:s A', strtotime($blocks->created_at));
            })
            ->editColumn('status', function ($blocks) {
                $a = $blocks->status == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $blocks->id .'" onClick="changeBlockStatus('.$blocks->id.','.$blocks->status.');">
                                   <div class="slider round"></div>
                               </label>';
            })->make(true);

    }

}
