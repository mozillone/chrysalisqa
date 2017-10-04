<?php namespace App\Http\Controllers;

use App\Category;
use Sitemap;
use App\Helpers\Site_model;
use URL;
use App\Helpers\StripeApp;
use DB;

class SitemapsController extends Controller
{
    

    public function index()
    {
        $staticUrl = URL::to('/');
        $catUrl = URL::to('/category');
        $productUrl = URL::to('/product');
        $pages = URL::to('/pages');
            $data = [
            0 => 'login',
            1 => 'press',
            2 => 'jobs',
            3 => 'events',
            4 => 'blogs',
        ];
       $domtree = new \DOMDocument('1.0', 'UTF-8');
        $xmlRoot = $domtree->createElement("urlset");
        $xmlRoot = $domtree->appendChild($xmlRoot);
        // create attribute node
        $xmlns = $domtree->createAttribute("xmlns:xhtml");
        $xmlRoot->appendChild($xmlns);
        // create attribute value node
        $xmlnsValue = $domtree->createTextNode("http://www.sitemaps.org/schemas/sitemap/0.9");
        $xmlns->appendChild($xmlnsValue);


        $cond=array("parent_id"=>"0");

        $currentTrack = $domtree->createElement("url");
        $currentTrack = $xmlRoot->appendChild($currentTrack);
        $currentTrack->appendChild($domtree->createElement('loc',$staticUrl)); 
        $currentTrack->appendChild($domtree->createElement('lastmod',date('Y-m-d')));
        $currentTrack->appendChild($domtree->createElement('changefreq','daily'));//<priority>0.8</priority>
        $currentTrack->appendChild($domtree->createElement('priority','0.6'));


        $getTopCategoriesList=Site_model::Fetch_data('category','*',$cond);
        $main_cat=$getTopCategoriesList[0]->name;
            $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $main_cat);
            $string =str_replace(array('\'', '"'), '', $string); 
            $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
            $currentTrack = $domtree->createElement("url");
            $currentTrack = $xmlRoot->appendChild($currentTrack);
            $currentTrack->appendChild($domtree->createElement('loc',$catUrl."/".strtolower(trim($string, '-')))); 
            $currentTrack->appendChild($domtree->createElement('lastmod',date('Y-m-d')));
            $currentTrack->appendChild($domtree->createElement('changefreq','daily'));//<priority>0.8</priority>
            $currentTrack->appendChild($domtree->createElement('priority','0.5'));
        foreach($getTopCategoriesList as $menus){
            $cond=array('parent_id'=>$menus->category_id);
            $getSubCategories=Site_model::Fetch_data('category','*',$cond);
            foreach ($getSubCategories as $subCat) {
                $link=Category::getUrlLinks($subCat->category_id);
                $costumes=Category::getCategoriesCostumes($subCat->category_id);
                foreach($costumes as $cst){
                    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $cst->name);
                    $string =str_replace(array('\'', '"'), '', $string); 
                    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
                    $currentTrack = $domtree->createElement("url");
                    $currentTrack = $xmlRoot->appendChild($currentTrack);
                    $currentTrack->appendChild($domtree->createElement('loc',$productUrl.$link."/".strtolower(trim($string, '-')))); 
                    $currentTrack->appendChild($domtree->createElement('lastmod',date('Y-m-d')));
                    $currentTrack->appendChild($domtree->createElement('changefreq','daily'));//<priority>0.8</priority>
                    $currentTrack->appendChild($domtree->createElement('priority','0.5'));
                }
                    $currentTrack = $domtree->createElement("url");
                    $currentTrack = $xmlRoot->appendChild($currentTrack);
                    $currentTrack->appendChild($domtree->createElement('loc',$catUrl.$link)); 
                    $currentTrack->appendChild($domtree->createElement('lastmod',date('Y-m-d')));
                    $currentTrack->appendChild($domtree->createElement('changefreq','daily'));//<priority>0.8</priority>
                    $currentTrack->appendChild($domtree->createElement('priority','0.5'));
            }
        }
        for ($i = 0; $i < count($data); $i++) {
            $currentTrack = $domtree->createElement("url");
            $currentTrack = $xmlRoot->appendChild($currentTrack);
            $currentTrack->appendChild($domtree->createElement('loc',$staticUrl."/".$data[$i])); 
            $currentTrack->appendChild($domtree->createElement('lastmod',date('Y-m-d')));
            $currentTrack->appendChild($domtree->createElement('changefreq','daily'));//<priority>0.8</priority>
            $currentTrack->appendChild($domtree->createElement('priority','0.6'));
        }
        $pages_arr=Site_model::Fetch_all_data('cms_pages','*');
        foreach ($pages_arr as $key => $node) {
            $currentTrack = $domtree->createElement("url");
            $currentTrack = $xmlRoot->appendChild($currentTrack);
            $currentTrack->appendChild($domtree->createElement('loc',$pages."/".$node->url)); 
            $currentTrack->appendChild($domtree->createElement('lastmod',date('Y-m-d')));
            $currentTrack->appendChild($domtree->createElement('changefreq','daily'));
            $currentTrack->appendChild($domtree->createElement('priority','0.7'));   
        }

        

        $domtree->save("sitemap.xml");

        echo"Sitemap Genrated";
    }
    public function stripeUsersUpdate($email){
        try{
            $this->stripe=new StripeApp();
         $customer=$this->stripe->customers($email);
        }catch(Exception $e){
           //Session::flash('error', $e->getMessage());
           //return Redirect::back();
            echo $e->getMessage();exit;
        }

       $oUser = User::where('email', $email)->first();
       $oUser->api_customer_id = $customer['id'];
       $oUser->save();
       
    }

    public function updateAttributesForSubcategories(){
        try{
            
        $cosplaySubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>147));

        $uniqueFashionSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>143));

        $filmTheatreSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>78));


        foreach ($cosplaySubCategories as $subCat) {
            $isAttrExist = DB::table('attribute_options')->where('option_value', $subCat->name)->first();
            if(!$isAttrExist){
                $attr_arr=array(
                    'attribute_id'=>25,
                    'option_value'=> $subCat->name,
                );
                $cosplay_yes_insert=DB::table('attribute_options')->insert($attr_arr);
            }
        }


        foreach ($uniqueFashionSubCategories as $subCat) {
            $isAttrExist = DB::table('attribute_options')->where('option_value', $subCat->name)->first();
            if(!$isAttrExist){
                $attr_arr=array(
                    'attribute_id'=>26,
                    'option_value'=> $subCat->name,
                );
                $cosplay_yes_insert=DB::table('attribute_options')->insert($attr_arr);
            }
        }


        foreach ($filmTheatreSubCategories as $subCat) {
            $isAttrExist = DB::table('attribute_options')->where('option_value', $subCat->name)->first();
            if(!$isAttrExist){
                $attr_arr=array(
                    'attribute_id'=>28,
                    'option_value'=> $subCat->name,
                );
                $cosplay_yes_insert=DB::table('attribute_options')->insert($attr_arr);
            }
        }



        }catch(Exception $e){
           //Session::flash('error', $e->getMessage());
           //return Redirect::back();
            echo $e->getMessage();exit;
        }

       
    }

}
