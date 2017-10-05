<?php

namespace App\Http\Controllers;

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
use Validator;
use Meta;
class PressController extends Controller
{

    public function __construct(Guard $auth)
    {
        Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
    }

    public function index(){
        Meta::set('title', 'Press');
        Meta::set('description', 'Read who is talking about Chrysalis');

        $posts = DB::table('press')->where('press.status',1)->orderBy('created_at', 'desc')->paginate(10);
        $blogPosts = DB::table('blog_posts')->where('blog_posts.status',1)->orderBy('created_at', 'desc')->limit(3)->get();
        return view('frontend.press.index')->with(array('posts'=>$posts,'blogPosts'=>$blogPosts));
    }

}
