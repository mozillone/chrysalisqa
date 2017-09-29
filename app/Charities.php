<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;

class Charities extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'id', 'name', 'suggested_by','image','status','created_at','updated_at'
    ];
    protected function createCharities($req,$user_id){
            if(isset($req['suggested_by'])){$suggested_by=$req['suggested_by'];}else{$suggested_by=$user_id;}
            $path=public_path('charities_images');
            $file_name=$this->fileUploading($path,$req['image']);
            $result=$this->create(['name'=>$req['name'],
                        'suggested_by'=>$suggested_by,
                        'image'=>$file_name
                        ])->id;
            return true;

    }
    protected function updateCharities($req){
            $path=public_path('charities_images');
            if(isset($req['image'])){
                $file_name=$this->fileUploading($path,$req['image']);
                $data=array('name'=>$req['charity_name'],
                            'image'=>$file_name,
                            'updated_at'=>date('y-m-d'));
            }else{
                 $data=array('name'=>$req['charity_name'],
                            'updated_at'=>date('y-m-d'));
            }
                $cond=array('id'=>$req['charity_id']);
                Site_model::update_data('charities',$data,$cond);
            return true;

    }
   public static function fileUploading($destinationPath,$file)
    {
        $file_name = $file->getClientOriginalName();
        $extension       = $file->getClientOriginalExtension() ?: 'png';
        $safeName        = str_random(10).'.'.$extension;
        $file->move($destinationPath,$safeName);
        return $safeName ;
    }
    protected function changeCharityStatus($req){
        $res=DB::Update('UPDATE cc_charities SET status="'.$req['data']['status'].'" WHERE id='.$req['data']['id']);
        return $res;
    }
    protected function getCharityInfo($charity_id){
        $res=DB::Select('select name from cc_charities where id='.$charity_id);
        return $res;
    }
   

}
