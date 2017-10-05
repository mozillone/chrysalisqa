<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
use App\User;
use Mail;
use Meta;
class BlogController extends Controller
{

    public function __construct(Guard $auth)
    {
        $this->sitehelper = new SiteHelper();
        Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
    }

    public function index(){
        Meta::set('title', 'Blog');
        Meta::set('description', 'Chrysalis Blog');

        $blogPosts = DB::table('blog_posts')
            ->where('blog_posts.status',1)
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        $blogCategories = DB::table('blog_categories')->get()->toArray();
        $yearFilters = DB::table('blog_posts')
            ->select(DB::raw('YEAR(created_at) year'))
            ->where('blog_posts.status', '=', 1)
            ->distinct()
            ->get();
        $userData = null;
        $userId = null;
        $userName = null;
        $userEmail = null;
        if(Auth::check()){
            $userData = User::find(Auth::user()->id)->toArray();
            $userId = $userData['id'];
            $userName = $userData['display_name'];
            $userEmail = $userData['email'];
        }
        return view('frontend.blog.index')->with(array(
            'blogPosts'=>$blogPosts,
            'blogCategories'=>$blogCategories,
            'yearFilters' => $yearFilters,
            'userName'=>$userName,
            'userEmail'=>$userEmail,
            'userId'=>$userId
        ));
    }

    public function show($id){
        $blogPost = DB::table('blog_posts')->where('blog_posts.id',$id)->first();
        $blogCategories = DB::table('blog_categories')->get()->toArray();
        $yearFilters = DB::table('blog_posts')
            ->select(DB::raw('YEAR(created_at) year'))
            ->where('blog_posts.status', '=', 1)
            ->distinct()
            ->get();
        $blogDescription = substr($blogPost->description,0,160);
        Meta::set('title', $blogPost->title);
        Meta::set('description', $blogDescription);
        return view('frontend/blog/view')->with(array(
            'blogPost'=>$blogPost,
            'blogCategories'=>$blogCategories,
            'yearFilters'=>$yearFilters
        ));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required|min:3|max:160',
            'email' => 'required|email|max:160',
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->send();
        } else {
            $userData = User::find(Auth::user()->id);
            $title = $request->input('title');
            $description = $request->input('description');
            if(!empty($request->input('category'))){
                $categoryId = $request->input('category');
            }else{
                $categoryId = 0;
            }
            $userId = $request->input('user_id');

            $postData = array(
                'title' => $title,
                'description' => $description,
                'posted_by' => 0,
                'status' => 0,
                'category_id' => $categoryId,
                'user_id' => $userData->id,
                'created_at' => date('y-m-d H:i:s')
            );
            $savePostData =DB::table('blog_posts')->insert($postData);

            if($savePostData){

                // send mail
                $reg_subject        = "Blog Created";
                $reg_data           = array('name'=>Auth::user()->display_name,'blogName'=>$title);
                $template           = 'emails.createblog';
                //---- send mail
                $reg_to             = Auth::user()->email;

                $mail_status        = $this->sitehelper->sendEmail($reg_to,$reg_subject,$template,$reg_data);
                // end mail

                Session::flash('success', 'Your blog post has been successfully created. It will be listed, once it is approved by admin.');
                return Redirect::to('blog');
            }else{
                Session::flash('error', 'There was a problem creating your blog post. Pls try again.');
                return Redirect::to('blog');
            }

        };
    }

    public function viewPostByCategory($id,$category){
        Meta::set('title', 'Blog');
        Meta::set('description', 'Chrysalis Blog');
        $postsByCategory = DB::table('blog_posts')->where(array('blog_posts.category_id'=>$id,'blog_posts.status'=>1))->orderBy('created_at', 'desc')->paginate(4);
        $categoryData = DB::table('blog_categories')->where('blog_categories.id',$id)->select('id','name')->first();
        $blogCategories = DB::table('blog_categories')->get();
        $yearFilters = DB::table('blog_posts')
            ->select(DB::raw('YEAR(created_at) year'))
            ->where('blog_posts.status', '=', 1)
            ->distinct()
            ->get();
        return view('frontend.blog.view_by_category')->with(array(
            'postsByCategory'=>$postsByCategory,
            'categoryData'=>$categoryData,
            'blogCategories'=>$blogCategories,
            'yearFilters'=>$yearFilters
        ));
    }

    public function viewPostByTag($tag){
        Meta::set('title', 'Blog');
        Meta::set('description', 'Chrysalis Blog');
        $postsByTag = DB::table('blog_posts')->whereRaw("FIND_IN_SET('$tag',tags)")->where('blog_posts.status',1)->orderBy('created_at', 'desc')->paginate(4);
        $blogCategories = DB::table('blog_categories')->get();
        $yearFilters = DB::table('blog_posts')
            ->select(DB::raw('YEAR(created_at) year'))
            ->where('blog_posts.status', '=', 1)
            ->distinct()
            ->get();
        return view('frontend.blog.view_by_tag')->with(array(
            'postsByTag'=>$postsByTag,
            'tag'=>$tag,
            'blogCategories'=>$blogCategories,
            'yearFilters'=>$yearFilters
        ));
    }

    public function viewPostByYears($year){
        Meta::set('title', 'Blog');
        Meta::set('description', 'Chrysalis Blog');
        $blogPosts = DB::table('blog_posts')->whereYear('created_at',$year)->where('blog_posts.status',1)->orderBy('created_at', 'desc')->paginate(4);
        $yearFilters = DB::table('blog_posts')
            ->select(DB::raw('YEAR(created_at) year'))
            ->where('blog_posts.status', '=', 1)
            ->distinct()
            ->get();
        $blogCategories = DB::table('blog_categories')->get();
        return view('frontend.blog.view_by_archives')->with(array(
            'blogPosts' => $blogPosts,
            'yearFilters'=>$yearFilters,
            'year'=>$year,
            'blogCategories'=>$blogCategories
        ));
    }
}
