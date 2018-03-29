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
use App\Helpers\Site_model;
use CmsPages;
use Meta;
class CmsController extends Controller
{
    public function __construct(Guard $auth)
    {
        Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
    }

    public function viewAboutUs(){
        Meta::set('title', 'About');
        Meta::set('description', 'About');
        $pageData = DB::table('cms_blocks')->where(array('cms_blocks.slug'=>'about-us','cms_blocks.status'=>1))->first();
        if(!empty($pageData)){
            if(count($pageData)){
                $blogPosts = DB::table('blog_posts')->where('blog_posts.status','=',1)->orderBy('created_at', 'desc')->get();
                $blogCategories = DB::table('blog_categories')->get()->toArray();
            }
            return view('frontend.pages.about_us')->with(array(
                'pageData'=>$pageData,
                'blogPosts'=>$blogPosts,
                'blogCategories' => $blogCategories
            ));
        }else{
            return view ('frontend.404');
        }
    }

    public function viewHowItWorks(){
        Meta::set('title', 'How It Works');
        Meta::set('description', 'How It Works');
        $pageData = DB::table('cms_pages')->where(array('cms_pages.url'=>'how-it-works','cms_pages.status'=>1))->first();
        $faqs = DB::table('faqs')->where(array('faqs.status'=>1,'faqs.block'=>'how-it-works'))->orderby('sort_no', 'asc')->get();
        if(!empty($pageData) && !empty($faqs)){
            return view('frontend.pages.how_it_works')->with(array('pageData'=>$pageData,'faqs'=>$faqs));
        }else{
            return view ('frontend.404');
        }
    }

    public function viewGivingBack(){
        Meta::set('title', 'Giving Back');
        Meta::set('description', 'Giving Back');
        $pageData = DB::table('cms_blocks')->where(array('cms_blocks.slug'=>'giving-back','cms_blocks.status'=>1))->first();
        $events = DB::table('events')
            ->where('events.approved','=',1)
            ->orderBy('events.created_at', 'desc')
            ->limit(10)
            ->get();
        return view('frontend.pages.giving_back')->with(array('pageData'=>$pageData,'events'=>$events));
    }

    public function viewTermsOfUse(){
        Meta::set('title', 'Terms Of Use');
        Meta::set('description', 'Terms Of Use - Chrysalis');
        $pageData = DB::table('cms_pages')->where(array('cms_pages.url'=>'terms-of-use','cms_pages.status'=>1))->first();
        if(!empty($pageData)){
            if(count($pageData)){
                return view('frontend.pages.terms_of_use')->with(array('pageData'=>$pageData));
            }
        }else{
            return view ('frontend.404');
        }
    }

    public function viewPrivacyPolicy(){
        Meta::set('title', 'Privacy Policy');
        Meta::set('description', 'Privacy Policy - Chrysalis');
        $pageData = DB::table('cms_pages')->where(array('cms_pages.url'=>'privacy-policy','cms_pages.status'=>1))->first();
        if(!empty($pageData)){
            if(count($pageData)){
                return view('frontend.pages.privacy_policy')->with(array('pageData'=>$pageData));
            }
        }else{
            return view ('frontend.404');
        }
    }

    public function viewOurMotto(){
        Meta::set('title', 'Our Motto');
        Meta::set('description', 'Our Motto - Chrysalis');
        $pageData = DB::table('cms_pages')->where(array('cms_pages.url'=>'our-motto','cms_pages.status'=>1))->first();
        if(!empty($pageData)){
            if(count($pageData)){
                return view('frontend.pages.our_motto')->with(array('pageData'=>$pageData));
            }
        }else{
            return view ('frontend.404');
        }
    }

    public function viewSellACostume(){
        $pageData = DB::table('cms_blocks')->where(array('cms_blocks.slug'=>'sell-a-costume','cms_blocks.status'=>1))->first();
        $faqs = DB::table('faqs')->where(array('faqs.status'=>1,'faqs.block'=>'sell-a-costume'))->orderby('sort_no','asc')->get();
        if(!empty($pageData) && !empty($faqs)){
            return view('frontend.costumes.sellacostume')->with(array('pageData'=>$pageData,'faqs'=>$faqs));
        }else{
            return view ('frontend.404');
        }
    }
}
