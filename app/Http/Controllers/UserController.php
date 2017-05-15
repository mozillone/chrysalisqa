<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Session;
use App\Helpers\SiteHelper;
use Hash;
use Response;

class UserController extends Controller
{
    protected $messageBag = null;
    

    public function __construct()
    {
      $this->sitehelper = new SiteHelper();
      $this->middleware(function ($request, $next) {
          if(!Auth::check()){
            return Redirect::to('/admin/login')->send();
          }
          else{
               return $next($request);
          }
      });
    }
  public function  EditProfile(Request $request)
  {
	$req=$request->all();
                                          if(count($req)){
                                          $name = User::find(Auth::user()->id);
                                          if(isset($req['avatar'])){
                                            $file_name = str_random(10).'.'.$req['avatar']->getClientOriginalExtension();
                                            $source_image_path=public_path('profile_img');
                                            $thumb_image_path1=public_path('profile_img');
                                            $thumb_image_path2=public_path('profile_img/thumbs');
                                            $req['avatar']->move($source_image_path, $file_name);
                                            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
                                            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,30,30);

                                          }
                                          else if(isset($req['is_removed'])){
                                            $file_name="";
                                          }
                                          else{
                                            $file_name=$name->avatar;
                                          }
                                          $userData = [
                                              'first_name' => $req['first_name'],
                                              'last_name' => $req['last_name'],
                                              'display_name' =>  $req['first_name']." ".$req['last_name'],
                                              'email'=>$req['email'],
                                              'user_img' =>$file_name
                                          ];
                                          if(!empty($req['password'])){
                                            $userData['password'] =  Hash::make($req['password']);
                                          }
                                          $affectedRows = User::where('id', '=', Auth::user()->id)->update($userData);
                                          Session::flash('success', 'Your profile is upadated successfully');
                                          return Redirect::back();
    return view('frontend.profile.edit_Profile');
  }
}
