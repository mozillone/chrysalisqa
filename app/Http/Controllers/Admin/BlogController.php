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
use App\User;
use App\Imageresize;
class BlogController extends Controller {

    public function __construct(){
        $this->sitehelper = new SiteHelper();
    }

	public function index() {
        $blogCategories = DB::table('blog_categories')->get();
		return view('admin.blog.blog-posts')->with(array('blogCategories'=>$blogCategories));
	}

    public function getAllPosts(){
        $blogPosts = DB::table('blog_posts')
            ->leftjoin('users', 'blog_posts.user_id', '=', 'users.id')
            ->select('blog_posts.id', 'blog_posts.posted_by', 'blog_posts.description','blog_posts.img', 'blog_posts.title', 'blog_posts.tags', 'blog_posts.status','blog_posts.category_id','users.display_name','blog_posts.created_at')
            ->get();
        return Datatables::of($blogPosts)
            ->addColumn('actions', function ($blogPosts) {
                return '<a href="/edit-blog-post/'.$blogPosts->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void(0);" onclick="deleteBlogPost('.$blogPosts->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->editColumn('created_at',function($blogPosts){
                return date('m/d/y h:i:s A', strtotime($blogPosts->created_at));
            })
            ->editColumn('display_name',function($blogPosts){
                return $blogPosts->display_name;
            })
            ->editColumn('category',function($blogPosts){
                if($blogPosts->category_id != 0){
                    $category = DB::table('blog_categories')->select('name')->where('blog_categories.id',$blogPosts->category_id)->first();
                    return $category->name;
                }
            })
            ->editColumn('status', function ($blogPosts) {
                $a = $blogPosts->status == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $blogPosts->id .'" onClick="changeBlogStatus('.$blogPosts->id.','.$blogPosts->status.');">
                                   <div class="slider round"></div>
                               </label>';
            })->make(true);
    }

	public function addBlogPost() {
        $blogCategories = DB::table('blog_categories')
            ->select('id', 'name')
            ->get();
		return view('admin.blog.add-blog-post')->with('blogCategories',$blogCategories);
	}

	public function store(Request $request){
        $req = $request->all();
        $validator = Validator::make($request->all(), [

            'title' => 'required|min:5|max:255',
            'post_desc' => 'required|min:5',
            'status' => 'required',
            'category' => 'required',
            'blogTags' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->send();
        } else {
            $userData = User::find(Auth::user()->id);

            if(isset($req['blogImage'])){
                $image = Imageresize::blogInsert($req['blogImage']);
                $file_name = $image;
            }

            $title = $request->input('title');
            $description = $request->input('post_desc');
            $status = $request->input('status');
            $categoryId = $request->input('category');
            $blogTags = $request->input('blogTags');

            $postData = array(
                'title' => $title,
                'description' => $description,
                'posted_by' => 1,
                'user_id' => $userData->id,
                'status' => $status,
                'category_id' => $categoryId,
                'tags' => $blogTags,
                'img' => $file_name,
                'created_at' => date('y-m-d H:i:s')
            );
            $savePostData =DB::table('blog_posts')->insert($postData);

            if($savePostData){
                Session::flash('success', 'Your blog post has been successfully created.');
                return Redirect::to('blog-posts');
            }else{
                Session::flash('error', 'There was a problem creating your blog post. Pls try again.');
                return Redirect::to('blog-posts');
            }

        };
    }

    public function blogPostSearch(Request $request){
        $req = $request->all();

        $blogs = DB::table('blog_posts')
            ->leftjoin('users', 'blog_posts.user_id', '=', 'users.id')
            ->select('blog_posts.id', 'blog_posts.posted_by', 'blog_posts.description','blog_posts.img', 'blog_posts.title', 'blog_posts.tags', 'blog_posts.status','blog_posts.category_id','users.display_name','blog_posts.created_at');


        if(isset($req['to_date']) && !empty($req['to_date'])){
            list($m,$d,$y) = explode("/",$req['to_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $to_date = date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['from_date']) && !empty($req['from_date'])){
            list($m,$d,$y) = explode("/",$req['from_date']);
            $timestamp = mktime(0,0,0,$m,$d,$y);
            $from_date= date("Y-m-d 23:59:59",$timestamp);
        }
        if(isset($req['title']) && !empty($req['title'])){
            $blogs->where('blog_posts.title','LIKE','%'.$req['title'].'%');
        }
        if(isset($req['category']) && !empty($req['category'])){
            $blogs->where('blog_posts.category_id','=',$req['category']);
        }
        if(isset($req['from_date']) && !empty($req['from_date']) && isset($req['to_date']) && !empty($req['to_date'])) {
            $blogs->whereBetween('blog_posts.created_at', array(date('Y-m-d h:i:s', strtotime($req['from_date'])), $to_date));
        }else if(isset($req['from_date']) && !empty($req['from_date'])){
            $blogs->where('blog_posts.created_at','>=',array(date('Y-m-d 00:00:01', strtotime($from_date))));
        }
        if(isset($req['posted_by']) && !empty($req['posted_by'])){
            if($req['posted_by'] == 'admin'){
                $req['posted_by'] = 1;
            }else if($req['posted_by'] == 'user'){
                $req['posted_by'] = 0;
            }
            $blogs->where('blog_posts.posted_by','=',$req['posted_by']);
        }

        if(isset($req['status']) && !empty($req['status'])){
            if($req['status'] == 'enabled'){
                $req['status'] = 1;
            }else if($req['status'] == 'disabled'){
                $req['status'] = 0;
            }
            $blogs->where('blog_posts.status','=',$req['status']);
        }
        $blogPosts = $blogs->get();

        return Datatables::of($blogPosts)
            ->addColumn('actions', function ($blogPosts) {
                return '<a href="/edit-blog-post/'.$blogPosts->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void(0);" onclick="deleteBlogPost('.$blogPosts->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->editColumn('display_name',function($blogPosts){
                return $blogPosts->display_name;
            })
            ->editColumn('category',function($blogPosts){
                $category = DB::table('blog_categories')->select('name')->where('blog_categories.id',$blogPosts->category_id)->first();
                return $category->name;
            })
            ->editColumn('created_at',function($blogPosts){
                return date('m/d/y h:i:s A', strtotime($blogPosts->created_at));
            })
            ->editColumn('status', function ($blogPosts) {
                $a = $blogPosts->status == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $blogPosts->id .'" onClick="changeBlogStatus('.$blogPosts->id.','.$blogPosts->status.');">
                                   <div class="slider round"></div>
                               </label>';
            })->make(true);
    }

    public function edit($id) {
        $blogPost = DB::table('blog_posts')->where('id',$id)->first();
        $blogCategories = DB::table('blog_categories')->select('id', 'name')->get();
        return view('admin.blog.edit',compact('blogPost','blogCategories'));
    }

    public function update($id, Request $request){
        $req = $request->all();
        if (count($req)) {
            $rule = array(
                'title'  => 'required|min:5|max:255',
                'post_desc'    => 'required|min:5',
                'status'  => 'required',
                'category'   => 'required',
                'blogTags' => 'required'
            );

            $validator = Validator::make($req, $rule);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->messages())->withInput();
            } else {

                $file_name = null;
                if(!empty($req['imageExists']) && empty($req['blogImage']) && $req['imageExists'] != 'removed'){
                    $file_name = $req['imageExists'];
                }else if(!empty($req['imageExists']) && !empty($req['blogImage'])){
                    $image = Imageresize::blogInsert($req['blogImage']);
                    $file_name = $image;
                }else if(empty($req['imageExists']) && !empty($req['blogImage'])){
                    $image = Imageresize::blogInsert($req['blogImage']);
                    $file_name = $image;
                }

                $postData = array(
                    'title' => $req['title'],
                    'description' => $req['post_desc'],
                    'img' => $file_name,
                    'posted_by' => $req['posted_by'],
                    'status' => $req['status'],
                    'category_id' => $req['category'],
                    'tags' => $req['blogTags'],
                    'updated_at' => date('y-m-d H:i:s')
                );

                $condition = array('id' => $id);
                $updatePostData = Site_model::update_data('blog_posts', $postData, $condition);
                if($updatePostData){
                    Session::flash('success', 'Blog Post updated successfully.');
                    return Redirect::to('blog-posts');
                }

            }

        }
        Session::flash('error', 'Blog post cannot be update. Pls try again.');
        return view('blog-posts');
    }

    public function addBlogCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->send();
        } else {
            $data = [];
            $categoryName = $request->input('name');

            $categoryData = array(
                'name' => $categoryName,
                'created_at' => date('y-m-d H:i:s')
            );

            $saveCategoryId =DB::table('blog_categories')->insertGetId($categoryData);

            if($saveCategoryId){
                $data['id'] = $saveCategoryId;
                $data['name'] = $categoryName;
                return json_encode($data);
            }

        }
    }

    public function editBlogCategory(Request $request, $id){

    }

    public function checkBlogCategory(Request $request){
        if($request->isMethod('get')){
            $req = $request->all();
            if(!empty($req)){
                $categories = DB::table('blog_categories')->where('name',$req['name'])->get();
                return count($categories);
            }
        }
    }

    public function deleteBlogCategory($id){
        $condition = array('id' => $id);
        $delete    = Site_model::delete_single('blog_categories', $condition);
        if ($delete) {
            Session::flash('success', 'Blog category has been deleted successfully.');
        } else {
            Session::flash('fail', 'Unable To delete this blog category. Pls try again.');
        }

        return redirect('add-blog-post');
    }

    public function destroy($id){
        $condition = array('id' => $id);
        $delete    = Site_model::delete_single('blog_posts', $condition);
        if ($delete) {
            Session::flash('success', 'Blog post has been deleted successfully.');
        } else {
            Session::flash('fail', 'Unable To delete this blog post. Pls try again.');
        }

        return redirect('blog-posts');
    }

    public function changeBlogStatus(Request $request){
        $id     = $request->input('id');
        $getBlog = DB::table('blog_posts')->where('id', $id)->first(['status']);
        if ($getBlog->status == 1) {
            $post = DB::table('blog_posts')->where('id', $id)->update(['status' => 0]);
        }else{
            $post = DB::table('blog_posts')->where('id', $id)->update(['status' => 1]);
        }

        return $post;
    }
}