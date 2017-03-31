<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\User;
use Session;
use Hash;
class CostumesController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
	
	}
	public function costumeListings()
	{
		return view('frontend.costumes.costumes_list');
	}
	public function costumeSingleView()
	{
		return view('frontend.costumes.costumes_single_view');
	}
}
