<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\SiteHelper;
use App\Helpers\Site_model;
class UrlRewritesController extends Controller
{

    public function __construct(){

    }

    public function generateUrlRewrites(){
        $query = "SELECT cc.costume_id,cd.name as costume_name,coc.name as subcat_name, coc2.name as cat_name FROM cc_costumes cc LEFT JOIN cc_costume_description cd ON cd.costume_id = cc.costume_id LEFT JOIN cc_costume_to_category ctc ON ctc.costume_id = cc.costume_id LEFT JOIN cc_category coc ON coc.category_id = ctc.category_id LEFT JOIN cc_category coc2 ON coc2.category_id = coc.parent_id WHERE cc.costume_id NOT IN ( SELECT url_offset FROM `cc_url_rewrites` WHERE type='product') AND cc.status = 'active' and cc.deleted_status = '0'";
        $costumes = DB::select(DB::Raw($query));
        $costumes = collect($costumes);
        $url_rewrites = array();
        $counter = 0;
        foreach ($costumes as $costume){
            $main_cat = SiteHelper::specialCharectorsRemove($costume->cat_name);
            $sub_cat = SiteHelper::specialCharectorsRemove($costume->subcat_name);
            $costume_name = SiteHelper::specialCharectorsRemove($costume->costume_name);
            $url_key = '/'.$main_cat.'/'.$sub_cat.'/'.$costume_name;
            $url_rewrites[$counter]['url_key'] = $url_key;
            $url_rewrites[$counter]['costume_id'] = $costume->costume_id;
            $counter++;
        }

        foreach ($url_rewrites as $rewrite_data){
            $url_count = SiteHelper::checkCostumeName($rewrite_data['url_key']);
            if($url_count > 0){
                $data=array('type'=>'product',
                    'url_offset'=>$rewrite_data['costume_id'],
                    'url_key'=> $rewrite_data['url_key'].$url_count++);
                Site_model::insert_data('url_rewrites',$data);
            }else{
                $data=array('type'=>'product',
                    'url_offset'=>$rewrite_data['costume_id'],
                    'url_key'=> $rewrite_data['url_key']);
                Site_model::insert_data('url_rewrites',$data);
            }
        }
    }

    public function deleteUrlRewrites(){
        $query = "SELECT url_offset, COUNT(*) counter FROM cc_url_rewrites WHERE type = 'product' GROUP BY url_offset HAVING counter > 1";
        $duplicate_urls = DB::select(DB::Raw($query));
        $duplicate_urls = collect($duplicate_urls);
        foreach ($duplicate_urls as $value){
            $costume_id = $value->url_offset;
            $query = "DELETE c1 FROM cc_url_rewrites as c1, cc_url_rewrites c2 WHERE c1.id > c2.id and c2.url_offset = c1.url_offset and c2.url_offset = $costume_id";
            $delete = DB::delete(DB::Raw($query));
        }
    }
}
