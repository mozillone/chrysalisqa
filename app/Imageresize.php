<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Imageresize extends Model
{
   
   protected function DashboardProfile($data){
   		$imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');
   			//dd($imageOptimizer);
   		$file_name = str_random(10).'.'.$data->getClientOriginalExtension();

   		//original image saving
        $originalPath=public_path('profile_img/original');
        $data->move($originalPath, $file_name);
		
		// thumbs resize 30X30
		$thumbPath=public_path('profile_img/thumbs');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		$imgOriginalSize->widen(30, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);
		
        // resizing the image 100X100
		$resizePath=public_path('profile_img/resize');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(100, function ($constraint) {
		   //$constraint->upsize();
		});


        $imgOriginalSize->save($resizePath.'/'.$file_name);
		$imageOptimizer->optimizeImage($resizePath.'/'.$file_name);

		return $file_name;

   }

   protected function CreateCostumeFrontend1($data){
   		$imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');

   		
		$file_name = str_random(10).'.'.$data->getClientOriginalExtension();
		
		//original image saving
    	$originalPath=public_path('costumers_images/Original');
    	$data->move($originalPath, $file_name);

    	// Large Image - Size 475 x 650
		$thumbPath=public_path('costumers_images/Large');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(475, 650);
		$imgOriginalSize->widen(475, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		//Medium Image 260 x 356
		$thumbPath=public_path('costumers_images/Medium');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(260, 356);
		$imgOriginalSize->widen(260, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		//Small Image - Size 140 x 190
		$thumbPath=public_path('costumers_images/Small');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(140, 190);
		$imgOriginalSize->widen(140, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		return $file_name;	
   		
   }

   protected function CreateCostumeFrontend2($data){
   		$imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');

   		
		$file_name = str_random(10).'.'.$data->getClientOriginalExtension();
		
		//original image saving
    	$originalPath=public_path('costumers_images/Original');
    	$data->move($originalPath, $file_name);

    	// Large Image - Size 475 x 650
		$thumbPath=public_path('costumers_images/Large');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//imgOriginalSize->resize(475, 650);
		$imgOriginalSize->widen(475, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		//Medium Image 260 x 356
		$thumbPath=public_path('costumers_images/Medium');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(260, 356);
		$imgOriginalSize->widen(260, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		//Small Image - Size 140 x 190
		$thumbPath=public_path('costumers_images/Small');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(140, 190);
		$imgOriginalSize->widen(140, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		return $file_name;	
   		
   }

   protected function CreateCostumeFrontend3($data){
   		$imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');

   		
		$file_name = str_random(10).'.'.$data->getClientOriginalExtension();
		
		//original image saving
    	$originalPath=public_path('costumers_images/Original');
    	$data->move($originalPath, $file_name);

    	// Large Image - Size 475 x 650
		$thumbPath=public_path('costumers_images/Large');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(475, 650);
		$imgOriginalSize->widen(475, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		//Medium Image 260 x 356
		$thumbPath=public_path('costumers_images/Medium');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(260, 356);
		$imgOriginalSize->widen(260, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		//Small Image - Size 140 x 190
		$thumbPath=public_path('costumers_images/Small');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(140, 190);
		$imgOriginalSize->widen(140, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		return $file_name;	
   		
   }

   protected function CreateCostumeFrontend4($data){
   	//echo "<pre>";print_r($data);die;
   		$imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');

   		
		$file_name = str_random(10).'.'.$data->getClientOriginalExtension();
		
		//original image saving
    	$originalPath=public_path('costumers_images/Original');
    	$data->move($originalPath, $file_name);

    	// Large Image - Size 475 x 650
		$thumbPath=public_path('costumers_images/Large');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(475, 650);
		$imgOriginalSize->widen(475, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		//Medium Image 260 x 356
		$thumbPath=public_path('costumers_images/Medium');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(260, 356);
		$imgOriginalSize->widen(260, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		//Small Image - Size 140 x 190
		$thumbPath=public_path('costumers_images/Small');
		$imgOriginalSize = Image::make($originalPath.'/'.$file_name);
		//$imgOriginalSize->resize(140, 190);
		$imgOriginalSize->widen(140, function ($constraint) {
		   //$constraint->upsize();
		});
		$imgOriginalSize->save($thumbPath.'/'.$file_name);
		$imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

		return $file_name;	
   		
   }

    protected function blogInsert($data){
        $imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');
        //dd($imageOptimizer);
        $file_name = str_random(10).'.'.$data->getClientOriginalExtension();

        //original image saving
        $originalPath=public_path('blog_images/original');
        $data->move($originalPath, $file_name);

        // thumbs resize 30X30
        $thumbPath=public_path('blog_images/thumbs');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(30, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($thumbPath.'/'.$file_name);
        $imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

        // filter thumbs resize 60X60
        $filterThumbPath=public_path('blog_images/filter_thumbs');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(60, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($filterThumbPath.'/'.$file_name);
        $imageOptimizer->optimizeImage($filterThumbPath.'/'.$file_name);

        // resizing the image 100X100
        $resizePath=public_path('blog_images/listing');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(300, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($resizePath.'/'.$file_name);
        $imageOptimizer->optimizeImage($resizePath.'/'.$file_name);

        // resizing the image 800X320
        $bannerPath=public_path('blog_images/banner');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(800, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($bannerPath.'/'.$file_name);
        $imageOptimizer->optimizeImage($bannerPath.'/'.$file_name);

        return $file_name;

    }

    protected function eventInsert($data){
        $imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');
        $file_name = str_random(10).'.'.$data->getClientOriginalExtension();

        //original image saving
        $originalPath=public_path('event_images/original');
        $data->move($originalPath, $file_name);

        // thumbs resize 30X30
        $thumbPath=public_path('event_images/thumbs');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(30, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($thumbPath.'/'.$file_name);
        $imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

        // resizing the image 300X100
        $resizePath=public_path('event_images');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(300, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($resizePath.'/'.$file_name);
        $imageOptimizer->optimizeImage($resizePath.'/'.$file_name);

        // resizing the image 350X245
        $masterPath=public_path('event_images/master_listing');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(350, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($masterPath.'/'.$file_name);
        $imageOptimizer->optimizeImage($masterPath.'/'.$file_name);

        return $file_name;

    }

    protected function pressInsert($data){
        $imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');
        $file_name = str_random(10).'.'.$data->getClientOriginalExtension();

        //original image saving
        $originalPath=public_path('press_images/original');
        $data->move($originalPath, $file_name);

        // thumbs resize 30X30
        $thumbPath=public_path('press_images/thumbs');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(30, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($thumbPath.'/'.$file_name);
        $imageOptimizer->optimizeImage($thumbPath.'/'.$file_name);

        // resizing the image 165X165
        $resizePath=public_path('press_images');
        $imgOriginalSize = Image::make($originalPath.'/'.$file_name);
        $imgOriginalSize->widen(165, function ($constraint) {
            //$constraint->upsize();
        });
        $imgOriginalSize->save($resizePath.'/'.$file_name);
        $imageOptimizer->optimizeImage($resizePath.'/'.$file_name);

        return $file_name;

    }

}