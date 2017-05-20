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

class CmsController extends Controller  {

	public function addCmsPage() {
		return view('admin.cms.add-cms-page');
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
}