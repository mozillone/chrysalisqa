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

class BlogController extends Controller {
	public function blogPosts() {
		return view('admin.blog.blog-posts');
	}

	public function addBlogPost() {
		return view('admin.blog.add-blog-post');
	}
}