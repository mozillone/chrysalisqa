<?php namespace App\Helpers;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use stdClass;
use Auth;
class Site_model extends Model {
use Authenticatable, CanResetPassword;
  

  
  protected function Fetch_data($table,$data,$cond){
    $data_info = DB::table($table)->select($data)                            
                           ->where($cond)->get();
        return $data_info;
   }
   protected function Fetch_all_data($table,$data){
    $data_info = DB::table($table)->select($data)->get();
        return $data_info;
   }
  protected function Fetch_data_count($table,$data){
    $data_info = DB::table($table)->where($data)->count();
        return $data_info;
   }
  protected function Fetch_all_data_order($table,$data,$orderby,$pos){
    $data_info = DB::table($table)->select($data)->orderBy($orderby,$pos)->get();
        return $data_info;
   }
  protected function insert_data($table,$data){
    $data_info = DB::table($table)->insert($data);
        return $data_info;
   }
   protected function insert_get_id($table,$data){
    $data_info = DB::table($table)->insertGetId($data);
        return $data_info;
   }
   protected function update_data($table,$data,$cond){
    $data_info = DB::table($table)->where($cond)->update($data);
    return $data_info;
   }  
    protected function delete_single($table,$cond){
    $data_info =DB::table($table)->where($cond)->delete();
        return $data_info;
   }  
    protected  function delete_all($table){
    $data_info = DB::table($table)->truncate();
        return $data_info;
   }  
   protected function fetch_datatable_data($table,$data,$cond){
    $data_info = DB::table($table)->select($data)                            
                           ->where($cond);
        return $data_info;
   }
  
  protected function fetch_master_id($table,$cond){
    $data_info = DB::table($table)->select('*')                            
                           ->where($cond)->get();
        return $data_info;
   }
   
  protected function find_user_and_meta($table,$user_id)
   {     
    $array=array();
         $where = array(
              'user_id'  => $user_id,
           );
      $query=DB::table($table)->select("*")->where($where)->get();
       if (count($query)) {

           

             foreach ($query as $key => $objects) {
               $array[$objects->meta_key] =$objects->meta_value;;
               }
       }
     if(count($array)>0){$meta=$array;}else{$meta="";} 
     return $meta;
   }

  protected  function userPermissions($user_id){
        $permissions=DB::Select('SELECT per.id,per.code FROM `tum_user_roles` as user_roles
                        JOIN tum_role_permissions as roles on roles.role_id=user_roles.role_id
                        JOIN tum_permissions as per on per.id=roles.permission_id
                        where user_roles.user_id='.$user_id);
        return $permissions;
    }
  
}
