<?php
namespace App\Http\Controllers;

use App\Site_model;
use Auth;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use paginate;
use Redirect;
use Session;
use Validator;

class UsercareersController extends Controller {
	//Careers Home Page Code Starts Here
	public function index() {
		//When Loading The careers Page defaultly keping the generic countryid
		Session::set('country', '220');
		$getsession = Session::get('country');
		$title      = "Career Center";
		/*******Queries For Search Bar Code Starts Here***/
		$careerscategories = DB::table('jobs_categories')

			->select('category_title as categoryname', 'id as id')
			->where('category_type', '=', 1)
			->get();

		$careerscountries = DB::table('us_countries')

			->select('country_name as countryname', 'id as id')

			->get();
		$carrerstypes = DB::table('carrers_types')
			->select('career_type as careertype', 'id as id')
			->get();
		$videos = DB::table('videos')->select('*')->limit(4)->get();
		/****Slot 1 code starts here************/
		$jobscat        = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_slots')->where('country_id', $getsession)
		                                             ->where('block_num', '1')->get();

		$menucount = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.country_id' => $feautures_response->country_id, 'sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country')
					->where($where)	->get();

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->country_id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($jobscat['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$workabroad     = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_slots')->where('country_id', $getsession)->where('block_num', '2')->get();
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.url as url', 'sub.image as image', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($workabroad['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$careerdevelopement = array('modules_result' => array());
		$hotelfeautures     = \DB::table('careers_slots')->where('country_id', $getsession)->where('block_num', '3')->get();
		$menucount          = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.url as url', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($careerdevelopement['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$careerresources = array('modules_result' => array());
		$hotelfeautures  = \DB::table('careers_slots')->where('country_id', $getsession)->where('block_num', '4')->get();
		$menucount       = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($careerresources['modules_result'], $module_array);
			}

		}
		/*****Services array code starts here***/
		$careerservices = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_slots')->where('country_id', $getsession)->where('block_num', '5')->get();
		$menucount      = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('id as id', 'title as title')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country'
					, 'sub.cDesc as description', 'sub.url as url')
					->where($where)	->get();

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($careerservices['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		$services = DB::table('content')
			->select('id as id', 'title as title')
			->where('country_id', $getsession)
			->where('slot_id', '5')	->get();
		$careervideos = DB::table('videos')->where('menu_id', '=', 3)->limit(4)->get();

		//Countries fecthing
		//Typs fetching
		return view('careers.careers', compact('title', 'countries', 'careerdevelopement', 'services', 'careerresources', 'categories', 'workabroad', 'careerscategories', 'careerscountries', 'carrerstypes', 'careers', 'videos', 'jobscat', 'careerservices', 'careervideos'));
	}
	/*****careers country code starts here**/
	public function careersCountry($country) {
		//Select id of the country
		$countryid    = $country;
		$countryname  = DB::table('countries')->select('country_name as countryname')->where('id', '=', $countryid)->first();
		$country_name = $countryname->countryname;

		Session::set('country', '220');
		$getsession = Session::get('country');
		$title      = "Career Center";
		/*******Queries For Search Bar Code Starts Here***/
		$careerscategories = DB::table('jobs_categories')

			->select('category_title as categoryname', 'id as id')
			->where('category_type', '=', 1)
			->get();

		$careerscountries = DB::table('us_countries')

			->select('country_name as countryname', 'id as id')

			->get();
		$carrerstypes = DB::table('carrers_types')
			->select('career_type as careertype', 'id as id')
			->get();
		$videos = DB::table('videos')->select('*')->limit(4)->get();
		/****Slot 1 code starts here************/
		$jobscat        = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '1')->get();

		$menucount = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.country_id' => $feautures_response->country_id, 'sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country')
					->where($where)	->get();

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->country_id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($jobscat['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$workabroad     = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '2')->get();
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.url as url', 'sub.image as image', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($workabroad['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$careerdevelopement = array('modules_result' => array());
		$hotelfeautures     = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '3')->get();
		$menucount          = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($careerdevelopement['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$careerresources = array('modules_result' => array());
		$hotelfeautures  = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '4')->get();
		$menucount       = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($careerresources['modules_result'], $module_array);
			}

		}
		/****servies code starts here**/
		$careerservices = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '5')->get();
		$menucount      = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country', 'cDesc as description', 'sub.url as url')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($careerservices['modules_result'], $module_array);
			}

		}
		/****Slot 1 code ends here************/

		$services = DB::table('content')                            ->
		select('id as id', 'title as title', 'cDesc as description')->where('country_id', $countryid)->where('slot_id', '5')->get();
		$careersvideos = DB::table('videos')->where('menu_id', '=', 3)->limit(4)->get();
		//Countries fecthing
		//Typs fetching
		return view('careers.careerscountry', compact('title', 'countries', 'careerdevelopement', 'services', 'careerresources', 'categories', 'workabroad', 'careerscategories', 'careerscountries', 'carrerstypes', 'careers', 'videos', 'jobscat', 'country_name', 'careerservices', 'careersvideos'));
	}

	/***careers filter view code starts heree**/
	public function careerView($category, $categoryname, $id) {
		$title       = "Careers";
		$careerslist = DB::table('careers')
			->select('careers.id as id', 'careers.title as title', 'careers.description as desc', 'careers.file_path as image', 'cat.cat_name as category', 'cu.country_name as country', 'ct.career_type as type')
			->leftJoin('careers_cats as cat', 'careers.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers.country_id', '=', 'cu.id')
			->leftJoin('carrers_types as ct', 'careers.type_id', '=', 'ct.id');
		switch ($category) {
			case "category":
				$careerslist->where('careers.cat_id', $id);
				break;
			case "country":
				$careerslist->where('careers.country_id', $id);
				break;
			case 'type':
				$careerslist->where('careers.type_id', $id);
				break;
		}
		$careers           = $careerslist->paginate(5);
		$careerscategories = DB::table('careers')
			->leftJoin('careers_cats', 'careers.cat_id', '=', 'careers_cats.id')
			->select('careers_cats.cat_name as categoryname', 'careers_cats.id as id', DB::raw("ifnull(count('careers.id'),0) as count"))
			->groupby('careers_cats.cat_name', 'careers_cats.id')
			->get();
		$careerscountries = DB::table('careers')
			->leftJoin('countries', 'careers.country_id', '=', 'countries.id')
			->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('careers.id'),0) as count"))
			->groupby('countries.country_name', 'countries.id')
			->get();
		$carrerstypes = DB::table('careers')
			->leftJoin('carrers_types', 'careers.type_id', '=', 'carrers_types.id')
			->select('carrers_types.career_type as careertype', 'carrers_types.id as id', DB::raw("ifnull(count('careers.id'),0) as count"))
			->groupby('carrers_types.career_type', 'carrers_types.id')
			->get();
		return view('careers.careersfilter', compact('title', 'careers', 'careerscategories', 'careerscountries', 'carrerstypes'));

	}
	/*****Advacnced serach code starts here**********/
	public function advancedSearch() {
		if (Auth::check()) {

			$careers = DB::table('jobs')
				->leftJoin('us_countries as u', 'u.id', '=', 'jobs.job_country')
				->select('jobs.id as id', 'jobs.job_title as job_title', 'jobs.job_description as job_description', 'jobs.job_expiry_date as job_expiry_date', 'u.country_name as country')
				->paginate(10);

			$careerscategories = DB::table('jobs')
				->leftJoin('jobs_categories', 'jobs.job_category', '=', 'jobs_categories.id')
				->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
				->groupby('jobs_categories.category_title', 'jobs_categories.id')

				->get();

			$careersindustry = DB::table('jobs')
				->leftJoin('jobs_categories', 'jobs.job_industry', '=', 'jobs_categories.id')
				->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
				->groupby('jobs_categories.category_title', 'jobs_categories.id')
				->get();
			$careerscountries = DB::table('jobs')
				->leftJoin('us_countries', 'jobs.job_country', '=', 'us_countries.id')
				->select('us_countries.country_name as countryname', 'us_countries.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
				->groupby('us_countries.country_name', 'us_countries.id')
				->get();
			$carrerstypes = DB::table('jobs')
				->leftJoin('carrers_types', 'jobs.job_type', '=', 'carrers_types.id')
				->select('carrers_types.career_type as careertype', 'carrers_types.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
				->groupby('carrers_types.career_type', 'carrers_types.id')
				->get();
			$industries = DB::table('jobs_categories')->get();

			$videos = DB::table('videos')->select('*')->limit(4)->get();
			return view('careers.careersadvancesearch', compact('careers', 'careerscategories', 'careerscountries', 'carrerstypes', 'careers', 'title', 'careersindustry', 'industries'));
		} else {
			return view('user.login');
		}
	}
	/****Advance search filter code starts here***/
	public function advancedSearchFilter(Request $request) {

		$title             = "Careers";
		$req               = $request->all();
		$careerscategories = DB::table('jobs')
			->leftJoin('jobs_categories', 'jobs.job_industry', '=', 'jobs_categories.id')
			->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('jobs_categories.category_title', 'jobs_categories.id')

			->get();

		$careersindustry = DB::table('jobs')
			->leftJoin('jobs_categories', 'jobs.job_category', '=', 'jobs_categories.id')
			->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('jobs_categories.category_title', 'jobs_categories.id')
			->get();
		$careerscountries = DB::table('jobs')
			->leftJoin('us_countries', 'jobs.job_country', '=', 'us_countries.id')
			->select('us_countries.country_name as countryname', 'us_countries.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('us_countries.country_name', 'us_countries.id')
			->get();
		$carrerstypes = DB::table('jobs')
			->leftJoin('carrers_types', 'jobs.job_type', '=', 'carrers_types.id')
			->select('carrers_types.career_type as careertype', 'carrers_types.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('carrers_types.career_type', 'carrers_types.id')
			->get();

		$titlesearch = $request->title;
		$industry    = $request->industry;
		$category    = $request->category;
		$subcategory = $request->subcategory;
		$country     = $request->country;
		$type        = $request->type;

		$careerslist = DB::table('jobs')
			->select('jobs.id as id', 'jobs.job_title as job_title', 'jobs.job_description as job_description', 'cat.category_title as category', 'cu.country_name as country', 'ct.career_type as type', 'jobs.job_expiry_date as job_expiry_date')
			->leftJoin('jobs_categories as cat', 'jobs.job_category', '=', 'cat.id')
			->leftJoin('us_countries as cu', 'jobs.job_country', '=', 'cu.id')
			->leftJoin('carrers_types as ct', 'jobs.job_type', '=', 'ct.id');
		if ($titlesearch != '') {
			$careerslist->where('jobs.job_title', 'LIKE', "%".$request->title."%")
					->orWhere('jobs.job_description', 'LIKE', "%".$request->title."%")
					->orWhere('jobs.job_requirements', 'LIKE', "%".$request->title."%");

			//$title=$request->title;
		}
		if ($industry != '') {
			$careerslist->where('jobs.job_industry', $industry);
		}
		if ($category != '') {

			$careerslist->where('jobs.job_category', $category);
		}
		if ($subcategory != '') {

			$careerslist->where('jobs.job_subcategory', $subcategory);
		}
		if ($country != '') {
			$careerslist->where('jobs.job_country', $request->country);
		}
		if ($type != '') {
			$careerslist->where('jobs.job_type', $request->type);
		}
		$jobs = $careerslist->paginate(5);

		return view('careers.careersadvancesearchfilters', compact('jobs', 'careers', 'title', 'titlesearch', 'category', 'countryname', 'typename', 'categoryx', 'countryx', 'typex', 'careerscategories', 'careersindustry', 'careerscountries', 'carrerstypes'));

	}

	/****careers types filter****/
	public function careerTypeView($category, $id, $countryid) {
		$title = "Careers Description";
		/****Category name and country name***/
		$countryname  = DB::table('countries')->select('country_name as country')->where('id', '=', $countryid)->first();
		$country_name = $countryname->country;

		/****Slot 1 code starts here************/
		$jobscat        = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '1')->get();

		$menucount = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.country_id' => $feautures_response->country_id, 'sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country')
					->where($where)	->get();
				//print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->country_id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($jobscat['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$workabroad     = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '2')->get();
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.url as url', 'sub.image as image', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($workabroad['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$careerdevelopement = array('modules_result' => array());
		$hotelfeautures     = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '3')->get();
		$menucount          = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($careerdevelopement['modules_result'], $module_array);
			}

		}

		/****Slot 1 code ends here************/
		/****Slot 2 code starts here************/
		$careerresources = array('modules_result' => array());
		$hotelfeautures  = \DB::table('careers_slots')->where('country_id', $countryid)->where('block_num', '4')->get();
		$menucount       = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				// /* >> sub module code start*/
				$where = array('sub.slot_id' => $feautures_response->id);

				$hotelfeautures = \DB::table('content as sub')
					->select('sub.title as title', 'sub.id as subid', 'sub.country_id as country')
					->where($where)	->get();
				// // print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($careerresources['modules_result'], $module_array);
			}

		}
		/******Single Description code starts here***/
		$description = DB::table('content')->select('id as id', 'title as title', 'cDesc as description')
		                                   ->where('id', '=', $id)->first();

		return view('careers.careerstypesfilters', compact('services_desc', 'title', 'careers', 'careerscategories', 'careerscountries', 'carrerstypes', 'jobscat', 'workabroad', 'careerdevelopement', 'careerresources', 'country_name', 'description'));
	}

	/****careers types filter ends here***/
	public function careersSearch(Request $request) {
		if (Auth::check()) {
			$title       = "Careers";
			$req         = $request->all();
			$titlesearch = $request->title;
			$category    = $request->category;
			$country     = $request->country;
			$type        = $request->type;

			$careerscategories = DB::table('jobs')
				->leftJoin('jobs_categories', 'jobs.job_category', '=', 'jobs_categories.id')
				->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
				->groupby('jobs_categories.category_title', 'jobs_categories.id')
				->get();

			$careersindustry = DB::table('jobs')
				->leftJoin('jobs_categories', 'jobs.job_industry', '=', 'jobs_categories.id')
				->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
				->groupby('jobs_categories.category_title', 'jobs_categories.id')
				->get();
			$careerscountries = DB::table('jobs')
				->leftJoin('us_countries', 'jobs.job_country', '=', 'us_countries.id')
				->select('us_countries.country_name as countryname', 'us_countries.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
				->groupby('us_countries.country_name', 'us_countries.id')
				->get();
			$carrerstypes = DB::table('jobs')
				->leftJoin('carrers_types', 'jobs.job_type', '=', 'carrers_types.id')
				->select('carrers_types.career_type as careertype', 'carrers_types.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
				->groupby('carrers_types.career_type', 'carrers_types.id')
				->get();

			$careerslist = DB::table('jobs')
				->select('jobs.id as id', 'jobs.job_title as job_title', 'jobs.job_description as job_description', 'cat.category_title as category', 'cu.country_name as country', 'ct.career_type as type', 'jobs.job_expiry_date as job_expiry_date')
				->leftJoin('jobs_categories as cat', 'jobs.job_category', '=', 'cat.id')
				->leftJoin('us_countries as cu', 'jobs.job_country', '=', 'cu.id')
				->leftJoin('carrers_types as ct', 'jobs.job_type', '=', 'ct.id');
			if ($titlesearch != '') {
				$careerslist->where('jobs.job_title', 'LIKE', "%".$request->title."%")
					->orWhere('jobs.job_description', 'LIKE', "%".$request->title."%")
					->orWhere('jobs.job_requirements', 'LIKE', "%".$request->title."%");

				//$title=$request->title;
			} else {
				$title = '';
			}
			if ($category != '') {

				$careerslist->where('jobs.job_category', $category);
				$category     = $request->category;
				$categoryname = DB::table('jobs_categories')->select('category_title as category')->where('id', $category)->first();
				$categoryx    = $categoryname->category;

			} else {
				$category  = '';
				$categoryx = '';
			}
			if ($country != '') {
				$careerslist->where('jobs.job_country', $request->country);
				$country     = $request->country;
				$countryname = DB::table('us_countries')->select('country_name as country')->where('id', $country)->first();
				$countryx    = $countryname->country;
			} else {
				$countryx = '';
			}
			if ($type != '') {
				$careerslist->where('jobs.job_type', $request->type);
				$type     = $request->type;
				$typename = DB::table('carrers_types')->select('career_type as careertype')->where('id', $type)->first();
				$typex    = $typename->careertype;
			} else {
				$type  = '';
				$typex = '';
			}
			$jobs = $careerslist->paginate(5);

			return view('careers.careerssearch', compact('careers', 'title', 'titlesearch', 'category', 'countryname', 'typename', 'categoryx', 'countryx', 'typex', 'careerscategories', 'careersindustry', 'careerscountries', 'carrerstypes', 'jobs'));
		} else {
			return view('user.login');
		}
	}
	/****careers single page view***/
	public function singleView($id) {

		$careersview = DB::table('jobs')
			->leftJoin('jobs_categories as cat', 'jobs.job_category', '=', 'cat.id')
			->leftJoin('us_countries as cu', 'jobs.job_country', '=', 'cu.id')
			->leftJoin('carrers_types as ct', 'jobs.job_type', '=', 'ct.id')
			->leftJoin('users as u', 'u.id', '=', 'jobs.created_by')
			->select('jobs.id as careerid', 'jobs.company_name as companyname', 'jobs.job_title as title', 'jobs.job_description as desc', 'jobs.job_category as categoryid', 'jobs.job_country as countryid', 'jobs.job_salary as salary',
			'jobs.job_type as careertypeid', 'cat.category_title as categoryname', 'cu.country_name as countryname', 'ct.career_type as type', 'jobs.job_city as city', 'jobs.job_expiry_date as expiredate', 'jobs.job_benefits as job_benefits', 'jobs.job_requirements as job_requirements', 'u.fname as username', 'u.email as email', 'u.resume as resume', 'jobs.created_by as userid')
			->where('jobs.id', $id)	->first();
		$useridauth  = Auth::user()->id;
		$userdetails = DB::table('users')->select('*')->where('id', '=', $useridauth)->first();

		return view('careers.jobdescription', compact('careersview', 'title', 'userdetails'));

	}
	/***careers Description**/
	public function careersSingleview($id) {

		$title       = "Career Center";
		$careersview = DB::table('careers')
			->leftJoin('careers_cats as cat', 'careers.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers.country_id', '=', 'cu.id')
			->leftJoin('carrers_types as ct', 'careers.type_id', '=', 'ct.id')
			->select('careers.id as careerid', 'careers.title as title', 'careers.description as desc', 'careers.file_path as image', 'careers.cat_id as categoryid', 'careers.country_id as countryid',
			'careers.type_id as careertypeid', 'cat.cat_name as categoryname', 'cu.country_name as countryname', 'ct.career_type as type')
			->where('careers.id', $id)	->first();
		//print_r($careersview);
		return view('careers.careerssinglepage', compact('careersview', 'title'));

	}
	//Educational Conferences code fetching code starts here
	public function educationConferences() {
		$title       = "Education Conferences";
		$conferences = DB::table('education_conferences')
			->leftJoin('careers_cats as cat', 'education_conferences.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'education_conferences.country_id', '=', 'cu.id')
			->leftJoin('users as u', 'education_conferences.created_user_id', '=', 'u.id')
			->select('education_conferences.id as id', 'education_conferences.created_at as created_at', 'education_conferences.title as title', 'education_conferences.description as desc', 'cat.cat_name as category', 'cu.country_name as country', 'u.fname as fname', 'file_path as image')
			->orderBy('created_at', 'desc')	->paginate(5);
		$conferencecategories = DB::table('education_conferences')
			->leftJoin('careers_cats', 'education_conferences.cat_id', '=', 'careers_cats.parent_id')
			->select('careers_cats.cat_name as categoryname', 'careers_cats.parent_id as id', DB::raw("ifnull(count('education_conferences.id'),0) as count"))
			->groupby('careers_cats.cat_name', 'careers_cats.parent_id')
			->get();

		$conferncecountries = DB::table('education_conferences')
			->leftJoin('countries', 'education_conferences.country_id', '=', 'countries.id')
			->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('education_conferences.id'),0) as count"))
			->groupby('countries.country_name', 'countries.id')
			->get();
		return view('careers.educationconferences', compact('title', 'countries', 'categories', 'conferences', 'conferencecategories', 'conferncecountries'));
	}

	//Media-interviews code starts here
	public function mediaInterviews() {
		$title = "Media Interviews";
		$media = DB::table('careers_media_intrvw')
			->leftJoin('media_cats as cat', 'careers_media_intrvw.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_media_intrvw.country_id', '=', 'cu.id')
			->leftJoin('users as u', 'careers_media_intrvw.created_user_id', '=', 'u.id')
			->select('careers_media_intrvw.id as id', 'careers_media_intrvw.title as title', 'careers_media_intrvw.description as desc', 'cat.cat_name as category', 'cu.country_name as country', 'u.fname as fname', 'careers_media_intrvw.file_path as image', 'careers_media_intrvw.created_at as created_at')
			->orderBy('created_at', 'desc')
			->paginate(5);
		$mediacategories = DB::table('careers_media_intrvw')->leftJoin('media_cats', 'careers_media_intrvw.cat_id', '=', 'media_cats.parent_id')
		                                                    ->select('media_cats.cat_name as categoryname', 'media_cats.parent_id as id', DB::raw("ifnull(count('careers_media_intrvw.id'),0) as count"))
		                                                    ->groupby('media_cats.cat_name', 'media_cats.parent_id')
		                                                    ->get();
		$mediacountries = DB::table('careers_media_intrvw')->leftJoin('countries', 'careers_media_intrvw.country_id', '=', 'countries.id')
		                                                   ->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('careers_media_intrvw.id'),0) as count"))
		                                                   ->groupby('countries.country_name', 'countries.id')
		                                                   ->get();
		return view('careers.mediainterviews', compact('mediacategories', 'mediacountries', 'media', 'title'));
	}
	//Latest News Code Starts Here
	public function latestNews() {
		//Get menu and submenu code starts heree
		$title          = "Latest News";
		$latestnews     = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_news as careers')->leftJoin('media_cats', 'careers.cat_id', '=', 'media_cats.parent_id')->select('media_cats.cat_name as category', 'careers.cat_id')->distinct()->get();
		$menucount      = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {
				$module_array['count'] = $feautures_response->cat_id;
				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				/* >> sub module code start*/
				$where = array('sub.cat_id' => $feautures_response->cat_id);

				$hotelfeautures = \DB::table('careers_news as sub')
					->select('sub.*', 'media_cats.*', 'countries.*')
					->leftJoin('media_cats', 'media_cats.parent_id', '=', 'sub.cat_id')
					->leftJoin('countries', 'countries.id', '=', 'sub.country_id')
					->where($where)
					->orderBy('sub.created_at', 'desc')
					->limit(3)
					->get();

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->cat_id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($latestnews['modules_result'], $module_array);
			}

		}

		$categories = DB::table('media_cats')->get();
		$countries  = DB::table('countries')->get();
		return view('careers.latestnews', compact('latestnews', 'categories', 'countries', 'title'));
	}
	//Press Releases code starts here
	public function pressReleases() {
		$title         = "Press Releases";
		$pressreleases = DB::table('press_releases')
			->leftJoin('careers_cats as cat', 'press_releases.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'press_releases.country_id', '=', 'cu.id')
			->leftJoin('users as u', 'press_releases.created_user_id', '=', 'u.id')
			->select('press_releases.id as id', 'press_releases.title as title', 'press_releases.description as desc', 'cat.cat_name as category', 'cu.country_name as country', 'u.fname as fname', 'press_releases.file_path as image', 'press_releases.created_at as created_at')
			->orderBy('created_at', 'desc')
			->paginate(5);
		$presscategories = DB::table('press_releases')->leftJoin('careers_cats', 'press_releases.cat_id', '=', 'careers_cats.parent_id')
		                                              ->select('careers_cats.cat_name as categoryname', 'careers_cats.parent_id as id', DB::raw("ifnull(count('press_releases.id'),0) as count"))
		                                              ->groupby('careers_cats.cat_name', 'careers_cats.parent_id')
		                                              ->get();
		$presscountries = DB::table('press_releases')->leftJoin('countries', 'press_releases.country_id', '=', 'countries.id')
		                                             ->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('press_releases.id'),0) as count"))
		                                             ->groupby('countries.country_name', 'countries.id')
		                                             ->get();
		return view('careers.pressreleases', compact('presscountries', 'presscategories', 'pressreleases', 'title'));
	}
	/*****Photo Gallery Code Starts Here****/
	public function photoGallery(Request $request) {
		$title          = "photo Gallery";
		$photogallery   = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_gallery as gallery')->leftJoin('media_cats', 'gallery.cat_id', '=', 'media_cats.parent_id')->select('media_cats.cat_name as category', 'gallery.cat_id')->distinct()->get();
		$menucount      = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}
				$module_array['submenu_result'] = array();
				/* >> sub module code start*/
				$where = array('sub.cat_id' => $feautures_response->cat_id);

				$hotelfeautures = \DB::table('careers_gallery as sub')
					->select('sub.id as galleryid', 'sub.title as title', 'sub.created_at', 'sub.description as description', 'sub.file_path as file_path', 'media_cats.*', 'countries.*')
					->leftJoin('media_cats', 'media_cats.parent_id', '=', 'sub.cat_id')
					->leftJoin('countries', 'countries.id', '=', 'sub.country_id')
					->where($where)
					->orderBy('sub.created_at', 'desc')
					->limit(10)
					->get();
				// print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array                = array();
					$submodule_array['totalvideos'] = $sub_count;
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->cat_id;

						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($photogallery['modules_result'], $module_array);
			}

		}
		//  print_r($photogallery);
		$gallerycategories = DB::table('careers_gallery')->leftJoin('media_cats', 'careers_gallery.cat_id', '=', 'media_cats.parent_id')
		                                                 ->select('media_cats.cat_name as categoryname', 'media_cats.parent_id as id')
		                                                 ->distinct()
		                                                 ->get();

		$gallerycountries = DB::table('careers_gallery')->leftJoin('countries', 'careers_gallery.country_id', '=', 'countries.id')
		                                                ->select('countries.country_name as countryname', 'countries.id as id')
		                                                ->distinct()
		                                                ->get();
		//print_r($gallerycountries);
		return view('careers.photogallery', compact('gallerycategories', 'gallerycountries', 'photogallery', 'title'));
	}
	/*******************************************Single view pages code starts here***************************************/
	/****educational conference view ***********/
	public function educationConferenceview($id) {
		$title                = "Education Conferences";
		$educationconferences = DB::table('education_conferences')
			->leftJoin('careers_cats as cat', 'education_conferences.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'education_conferences.country_id', '=', 'cu.id')
			->where('education_conferences.id', $id)	->first();
		//print_r($educationconferences);
		return view('careers.educationconferenceview', compact('educationconferences', 'title'));
	}
	/******Latest news view*************/
	public function pressReleasesview($id) {
		$title         = "Press Releases";
		$pressreleases = DB::table('press_releases')
			->leftJoin('careers_cats as cat', 'press_releases.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'press_releases.country_id', '=', 'cu.id')
			->where('press_releases.id', $id)	->first();
		return view('careers.pressreleasesview', compact('pressreleases', 'title'));
	}
	/*****Media Interviews view***********/
	public function mediaInterviewsview($id) {
		$title           = "Media Interviews";
		$mediainterviews = DB::table('careers_media_intrvw')
			->leftJoin('media_cats as cat', 'careers_media_intrvw.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_media_intrvw.country_id', '=', 'cu.id')
			->where('careers_media_intrvw.id', $id)	->first();
		return view('careers.mediainterviewsview', compact('mediainterviews', 'title'));
	}
	/******Latest News View based on category code starts here***************/
	public function latestNewsView($catgeory, $categoryname, $id) {
		$title        = "Latest News";
		$categoryname = DB::table('careers_news')->select('cat.cat_name as category', 'careers_news.cat_id as categoryid')
		                                         ->leftJoin('media_cats as cat', 'careers_news.cat_id', '=', 'cat.id')
		                                         ->where('careers_news.cat_id', $id)
		                                         ->first();
		//print_r($categoryname);
		$latestnews = DB::table('careers_news')
			->select('careers_news.id as id', 'careers_news.title as title', 'careers_news.description as desc', 'cat.cat_name as category', 'cu.country_name as country', 'careers_news.created_at as created_at')
			->leftJoin('media_cats as cat', 'careers_news.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_news.country_id', '=', 'cu.id')
			->orderBy('created_at', 'desc')
			->where('careers_news.cat_id', $id)
			->paginate(5);

		$latestnewscategories = DB::table('careers_news')->leftJoin('media_cats', 'careers_news.cat_id', '=', 'media_cats.parent_id')
		                                                 ->select('media_cats.cat_name as categoryname', 'media_cats.parent_id as id', DB::raw("ifnull(count('careers_news.id'),0) as count"))
		                                                 ->groupby('media_cats.cat_name', 'media_cats.parent_id')
		                                                 ->get();
		$latestnewscountries = DB::table('careers_news')->leftJoin('countries', 'careers_news.country_id', '=', 'countries.id')
		                                                ->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('careers_news.id'),0) as count"))
		                                                ->groupby('countries.country_name', 'countries.id')
		                                                ->get();

		return view('careers.latestnewsview', compact('latestnewscategories', 'latestnewscountries', 'latestnews', 'categoryname', 'title'));
	}
	/*****Latedt News single view code starts here****/
	public function latestNewssingleView($id) {
		$title           = "Latest News";
		$latestnewsviews = DB::table('careers_news')
			->leftJoin('media_cats as cat', 'careers_news.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_news.country_id', '=', 'cu.id')
			->where('careers_news.id', $id)	->first();
		return view('careers.latestnewssingleview', compact('latestnewsviews', 'title'));
	}
	/*******Photo Gallery View all code starts here***/
	public function photoGalleryView($category, $categoryname, $id) {
		$title        = "Photo Gallery";
		$categoryname = DB::table('careers_gallery')->select('cat.cat_name as category', 'cat.id as categoryid')
		                                            ->leftJoin('media_cats as cat', 'careers_gallery.cat_id', '=', 'cat.id')
		                                            ->where('careers_gallery.cat_id', $id)
		                                            ->first();
		//print_r($categoryname);
		$photogallerylist = DB::table('careers_gallery')
			->select('careers_gallery.id as id', 'careers_gallery.title as title', 'careers_gallery.description as desc', 'careers_gallery.file_path as image', 'cat.cat_name as category', 'cu.country_name as country')
			->leftJoin('media_cats as cat', 'careers_gallery.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_gallery.country_id', '=', 'cu.id');
		switch ($category) {
			case 'category':
				$photogallerylist->where('careers_gallery.cat_id', $id);
				break;
			case 'country':
				$photogallerylist->where('careers_gallery.country_id', $id);
				break;
		}
		$photogallery      = $photogallerylist->paginate(5);
		$gallerycategories = DB::table('careers_gallery')->leftJoin('media_cats', 'careers_gallery.cat_id', '=', 'media_cats.parent_id')
		                                                 ->select('media_cats.cat_name as categoryname', 'media_cats.parent_id as id', DB::raw("ifnull(count('careers_gallery.id'),0) as count"))
		                                                 ->groupby('media_cats.cat_name', 'media_cats.parent_id')
		                                                 ->get();
		$gallerycountries = DB::table('careers_gallery')->leftJoin('countries', 'careers_gallery.country_id', '=', 'countries.id')
		                                                ->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('careers_news.id'),0) as count"))
		                                                ->groupby('countries.country_name', 'countries.id')
		                                                ->get();
		return view('careers.photogalleryview', compact('gallerycategories', 'gallerycountries', 'photogallery', 'categoryname', 'title'));
	}
	/********photo gallery single view code starts here***/
	public function photoGallerysingleview($id) {
		$title                   = "Photo Gallery";
		$photogallerysingleviews = DB::table('careers_gallery')
			->leftJoin('media_cats as cat', 'careers_gallery.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_gallery.country_id', '=', 'cu.id')
			->where('careers_gallery.id', $id)	->first();
		return view('careers.photogallerysingleview', compact('photogallerysingleviews', 'title'));

	}
	/*******************************Search code starts here for all here***/
	//conferences search
	public function Conferencessearch($category, $categoryname, $id) {
		$title = "Education Conferences";

		$conferenceslist = DB::table('education_conferences')
			->leftJoin('careers_cats as cat', 'education_conferences.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'education_conferences.country_id', '=', 'cu.id')
			->leftJoin('users as u', 'education_conferences.created_user_id', '=', 'u.id')
			->select('education_conferences.id as id', 'education_conferences.created_at as created_at', 'education_conferences.title as title', 'education_conferences.description as desc', 'cat.cat_name as category', 'cu.country_name as country', 'u.fname as fname', 'file_path as image');

		switch ($category) {
			case 'category':
				$conferenceslist->where('education_conferences.cat_id', $id);
				break;
			case 'country':
				$conferenceslist->where('education_conferences.country_id', $id);
				break;
		}
		$conferences          = $conferenceslist->orderBy('created_at', 'desc')->paginate(5);
		$conferencecategories = DB::table('education_conferences')
			->leftJoin('careers_cats', 'education_conferences.cat_id', '=', 'careers_cats.parent_id')
			->select('careers_cats.cat_name as categoryname', 'careers_cats.parent_id as id', DB::raw("ifnull(count('education_conferences.id'),0) as count"))
			->groupby('careers_cats.cat_name', 'careers_cats.parent_id')
			->get();

		$conferncecountries = DB::table('education_conferences')
			->leftJoin('countries', 'education_conferences.country_id', '=', 'countries.id')
			->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('education_conferences.id'),0) as count"))
			->groupby('countries.country_name', 'countries.id')
			->get();

		return view('careers.educationconferencesajax', compact('countries', 'categories', 'conferences', 'conferencecategories', 'conferncecountries', 'title'));
	}
	//JObs serach filter code starts here
	public function jobFilter($category, $categoryname, $id) {

		$title    = "Jobs Listing";
		$jobslist = DB::table('jobs')
				->leftJoin('us_countries as u', 'u.id', '=', 'jobs.job_country')
				->select('jobs.id as id', 'jobs.job_title as job_title', 'jobs.job_description as job_description', 'jobs.job_expiry_date as job_expiry_date', 'u.country_name as country');
				
		switch ($category) {

			case 'category':
				$jobslist->where('jobs.job_category', $id);
				break;
			case 'country':
				$jobslist->where('jobs.job_country', $id);
				break;
			case 'industry':
				$jobslist->where('jobs.job_industry', $id);
				break;
			case 'type':
				$jobslist->where('jobs.job_type', $id);
				break;

		}
		$careerscategories = DB::table('jobs')
			->leftJoin('jobs_categories', 'jobs.job_category', '=', 'jobs_categories.id')
			->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('jobs_categories.category_title', 'jobs_categories.id')

			->get();

		$careersindustry = DB::table('jobs')
			->leftJoin('jobs_categories', 'jobs.job_industry', '=', 'jobs_categories.id')
			->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('jobs_categories.category_title', 'jobs_categories.id')
			->get();
		$careerscountries = DB::table('jobs')
			->leftJoin('us_countries', 'jobs.job_country', '=', 'us_countries.id')
			->select('us_countries.country_name as countryname', 'us_countries.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('us_countries.country_name', 'us_countries.id')
			->get();
		$carrerstypes = DB::table('jobs')
			->leftJoin('carrers_types', 'jobs.job_type', '=', 'carrers_types.id')
			->select('carrers_types.career_type as careertype', 'carrers_types.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('carrers_types.career_type', 'carrers_types.id')
			->get();
		$jobs = $jobslist->get();

		return view('careers.jobsfilter', compact('gallerycategories', 'gallerycountries', 'photogallery', 'categoryname', 'title', 'jobs', 'careerscategories', 'careerscountries', 'carrerstypes', 'careersindustry'));
	}
	//pressreleases search
	public function pressReleasesSearch($category, $categoryname, $id) {
		$title             = "Press Releases";
		$pressreleaseslist = DB::table('press_releases')
			->leftJoin('careers_cats as cat', 'press_releases.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'press_releases.country_id', '=', 'cu.id')
			->leftJoin('users as u', 'press_releases.created_user_id', '=', 'u.id')
			->select('press_releases.id as id', 'press_releases.title as title', 'press_releases.description as desc', 'cat.cat_name as category', 'cu.country_name as country', 'u.fname as fname', 'press_releases.file_path as image', 'press_releases.created_at as created_at');
		switch ($category) {
			case 'category':
				$pressreleaseslist->where('press_releases.cat_id', $id);
				break;
			case 'country':
				$pressreleaseslist->where('press_releases.country_id', $id);
				break;
		}
		$presscategories = DB::table('press_releases')->leftJoin('careers_cats', 'press_releases.cat_id', '=', 'careers_cats.parent_id')
		                                              ->select('careers_cats.cat_name as categoryname', 'careers_cats.parent_id as id', DB::raw("ifnull(count('press_releases.id'),0) as count"))
		                                              ->groupby('careers_cats.cat_name', 'careers_cats.parent_id')
		                                              ->get();
		$presscountries = DB::table('press_releases')->leftJoin('countries', 'press_releases.country_id', '=', 'countries.id')
		                                             ->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('press_releases.id'),0) as count"))
		                                             ->groupby('countries.country_name', 'countries.id')
		                                             ->get();
		$pressreleases = $pressreleaseslist->orderBy('created_at', 'desc')->paginate(5);

		return view('careers.pressreleasessearch', compact('presscountries', 'presscategories', 'pressreleases', 'title'));
	}
	//media interviews search code starts here
	public function mediaInterviewssearch($category, $categoryname, $id) {
		$title     = "Media Interviews";
		$medialist = DB::table('careers_media_intrvw')
			->leftJoin('media_cats as cat', 'careers_media_intrvw.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_media_intrvw.country_id', '=', 'cu.id')
			->leftJoin('users as u', 'careers_media_intrvw.created_user_id', '=', 'u.id')
			->select('careers_media_intrvw.id as id', 'careers_media_intrvw.title as title', 'careers_media_intrvw.description as desc', 'cat.cat_name as category', 'cu.country_name as country', 'u.fname as fname', 'careers_media_intrvw.file_path as image', 'careers_media_intrvw.created_at as created_at');
		switch ($category) {
			case 'category':
				$medialist->where('careers_media_intrvw.cat_id', $id);
				break;
			case 'country':
				$medialist->where('careers_media_intrvw.country_id', $id);
				break;
		}
		$media = $medialist->orderBy('created_at', 'desc')->paginate(5);

		$mediacategories = DB::table('careers_media_intrvw')->leftJoin('media_cats', 'careers_media_intrvw.cat_id', '=', 'media_cats.parent_id')
		                                                    ->select('media_cats.cat_name as categoryname', 'media_cats.parent_id as id', DB::raw("ifnull(count('careers_media_intrvw.id'),0) as count"))
		                                                    ->groupby('media_cats.cat_name', 'media_cats.parent_id')
		                                                    ->get();
		$mediacountries = DB::table('careers_media_intrvw')->leftJoin('countries', 'careers_media_intrvw.country_id', '=', 'countries.id')
		                                                   ->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('careers_media_intrvw.id'),0) as count"))
		                                                   ->groupby('countries.country_name', 'countries.id')
		                                                   ->get();
		return view('careers.mediainterviewssearch', compact('mediacountries', 'mediacategories', 'media', 'title'));

	}
	/********Latest news search code starts here****/
	public function latestNewssearch(Request $request) {
		$title          = "Latest News";
		$category       = $request->category;
		$country        = $request->country;
		$latestnews     = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_news as careers')->leftJoin('media_cats', 'careers.cat_id', '=', 'media_cats.parent_id')->select('media_cats.cat_name as category', 'careers.cat_id')
		                                                       ->distinct()->where('careers.cat_id', $category)->get();
		$menucount = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				/* >> sub module code start*/
				$where = array('sub.cat_id' => $feautures_response->cat_id);

				$hotelfeautures = \DB::table('careers_news as sub')
					->select('sub.*', 'media_cats.*', 'countries.*')
					->leftJoin('media_cats', 'media_cats.parent_id', '=', 'sub.cat_id')
					->leftJoin('countries', 'countries.id', '=', 'sub.country_id')
					->where($where)
					->orderBy('sub.created_at', 'desc')
					->limit(3)
					->get();

				// print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->cat_id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($latestnews['modules_result'], $module_array);
			}

		}
		$categories = DB::table('media_cats')->get();
		$countries  = DB::table('countries')->get();
		return view('careers.latestnewssearch', compact('latestnews', 'categories', 'countries', 'title'));
	}
	/*****Latest news filters code starts here****/
	public function latestNewssearchsingle($category, $categoryname, $id, $catid) {
		$title        = "Latest News";
		$categoryname = DB::table('careers_news')->select('cat.cat_name as category', 'careers_news.cat_id as categoryid')
		                                         ->leftJoin('media_cats as cat', 'careers_news.cat_id', '=', 'cat.id')
		                                         ->first();
		//print_r($categoryname);
		$latestnews = DB::table('careers_news')
			->select('careers_news.id as id', 'careers_news.title as title', 'careers_news.description as desc', 'cat.cat_name as category', 'cu.country_name as country', 'careers_news.created_at as created_at')
			->leftJoin('media_cats as cat', 'careers_news.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_news.country_id', '=', 'cu.id')
		//->where('careers_news.cat_id',$catid)
			->where('careers_news.country_id', $id)
			->orderBy('created_at', 'desc')
			->paginate(5);
		//->orderByRaw("DATE('created_at')")
		$latestnewscategories = DB::table('careers_news')->leftJoin('media_cats', 'careers_news.cat_id', '=', 'media_cats.parent_id')
		                                                 ->select('media_cats.cat_name as categoryname', 'media_cats.parent_id as id', DB::raw("ifnull(count('careers_news.id'),0) as count"))
		                                                 ->groupby('media_cats.cat_name', 'media_cats.parent_id')
		                                                 ->get();
		$latestnewscountries = DB::table('careers_news')->leftJoin('countries', 'careers_news.country_id', '=', 'countries.id')
		                                                ->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('careers_news.id'),0) as count"))
		                                                ->groupby('countries.country_name', 'countries.id')
		                                                ->get();

		return view('careers.latestnewsview', compact('latestnewscategories', 'latestnewscountries', 'latestnews', 'categoryname', 'title'));

	}
	/*****Photo Gallery serach code starts here****/
	public function photoGallerySearch(Request $request) {
		$title          = "Photo Gallery";
		$category       = $request->category;
		$photogallery   = array('modules_result' => array());
		$hotelfeautures = \DB::table('careers_gallery as gallery')->leftJoin('media_cats', 'gallery.cat_id', '=', 'media_cats.parent_id')->select('media_cats.cat_name as category', 'gallery.cat_id')
		                                                          ->distinct()
		                                                          ->where('gallery.cat_id', $category)
		                                                          ->get();
		$menucount = count($hotelfeautures);
		if ($menucount > 0) {
			$module_array = array();
			foreach ($hotelfeautures as $feautures_response) {

				foreach ($feautures_response as $feauture_key => $feauture_val) {
					$module_array[$feauture_key] = $feauture_val;

				}

				$module_array['submenu_result'] = array();
				/* >> sub module code start*/
				$where = array('sub.cat_id' => $feautures_response->cat_id);

				$hotelfeautures = \DB::table('careers_gallery as sub')
					->select('sub.id as galleryid', 'sub.title as title', 'sub.created_at', 'sub.description as description', 'sub.file_path as file_path', 'media_cats.*', 'countries.*')
					->leftJoin('media_cats', 'media_cats.parent_id', '=', 'sub.cat_id')
					->leftJoin('countries', 'countries.id', '=', 'sub.country_id')
					->where($where)
					->orderBy('sub.created_at', 'desc')
					->limit(10)
					->get();
				// print_r($hotelfeautures);

				$sub_count = count($hotelfeautures);
				if ($sub_count > 0) {
					$submodule_array = array();
					foreach ($hotelfeautures as $sub_response) {
						$submodule_array['count'] = $feautures_response->cat_id;
						foreach ($sub_response as $sub_key => $sub_val) {
							$submodule_array[$sub_key] = $sub_val;
						}
						array_push($module_array['submenu_result'], $submodule_array);
						//print_r($module_array['submodule_result']);
					}
				}
				array_push($photogallery['modules_result'], $module_array);
			}

		}
		// print_r($photogallery);
		$gallerycategories = DB::table('careers_gallery')->leftJoin('media_cats', 'careers_gallery.cat_id', '=', 'media_cats.parent_id')
		                                                 ->select('media_cats.cat_name as categoryname', 'media_cats.parent_id as id', DB::raw("ifnull(count('careers_gallery.id'),0) as count"))
		                                                 ->groupby('media_cats.cat_name', 'media_cats.parent_id')
		                                                 ->get();
		$gallerycountries = DB::table('careers_gallery')->leftJoin('countries', 'careers_gallery.country_id', '=', 'countries.id')
		                                                ->select('countries.country_name as countryname', 'countries.id as id', DB::raw("ifnull(count('careers_news.id'),0) as count"))
		                                                ->groupby('countries.country_name', 'countries.id')
		                                                ->get();
		//print_r($gallerycountries);
		return view('careers.photogallerysearch', compact('gallerycategories', 'gallerycountries', 'photogallery', 'title'));
	}
	/****Photo Galleryllery view filters code starts her****/
	public function photoGalleryfilters($category, $categoryname, $id, $categoryid) {
		$title        = "Photo Gallery";
		$categoryname = DB::table('careers_gallery')->select('cat.cat_name as category')
		                                            ->leftJoin('media_cats as cat', 'careers_gallery.cat_id', '=', 'cat.id')
		                                            ->where('careers_gallery.cat_id', $category)
		                                            ->first();
		//print_r($categoryname);
		$photogallery = DB::table('careers_gallery')
			->select('careers_gallery.id as id', 'careers_gallery.title as title', 'careers_gallery.description as desc', 'careers_gallery.file_path as image', 'cat.cat_name as category', 'cu.country_name as country')
			->leftJoin('media_cats as cat', 'careers_gallery.cat_id', '=', 'cat.id')
			->leftJoin('countries as cu', 'careers_gallery.country_id', '=', 'cu.id')
			->where('careers_gallery.cat_id', $categoryid)
			->where('careers_gallery.cat_id', $id)
		//->orderByRaw("DATE('created_at')")
			->paginate(5);
		$gallerycategories = DB::table('careers_gallery')->leftJoin('media_cats', 'careers_gallery.cat_id', '=', 'media_cats.parent_id')
		                                                 ->select('media_cats.cat_name as categoryname', 'media_cats.parent_id as id')
		                                                 ->distinct()
		                                                 ->get();
		$gallerycountries = DB::table('careers_gallery')->leftJoin('countries', 'careers_gallery.country_id', '=', 'countries.id')
		                                                ->select('countries.country_name as countryname', 'countries.id as id')
		                                                ->distinct()
		                                                ->get();
		return view('careers.photogalleryview', compact('gallerycategories', 'gallerycountries', 'photogallery', 'categoryname', 'title'));

	}
	/*****Jobs displaying code starts here***/
	public function jobs() {
		$careerscategories = DB::table('jobs')
			->leftJoin('jobs_categories', 'jobs.job_category', '=', 'jobs_categories.id')
			->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('jobs_categories.category_title', 'jobs_categories.id')

			->get();

		$careersindustry = DB::table('jobs')
			->leftJoin('jobs_categories', 'jobs.job_industry', '=', 'jobs_categories.id')
			->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('jobs_categories.category_title', 'jobs_categories.id')
			->get();
		$careerscountries = DB::table('jobs')
			->leftJoin('us_countries', 'jobs.job_country', '=', 'us_countries.id')
			->select('us_countries.country_name as countryname', 'us_countries.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('us_countries.country_name', 'us_countries.id')
			->get();
		$carrerstypes = DB::table('jobs')
			->leftJoin('carrers_types', 'jobs.job_type', '=', 'carrers_types.id')
			->select('carrers_types.career_type as careertype', 'carrers_types.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('carrers_types.career_type', 'carrers_types.id')
			->get();
		$userid = Auth::user()->id;
		$jobs   = DB::table('jobs')
			->leftJoin('carrers_types as ct', 'ct.id', '=', 'jobs.job_type')
			->select('jobs.id as id',
			'jobs.company_name as company_name',
			'jobs.job_title as job_title',
			'jobs.job_description as job_description',
			'ct.career_type as career_type',
			DB::Raw('DATE_FORMAT(pp_jobs.created_date,"%m/%d/%y %h:%i %p") as createddate'),
			DB::Raw('DATE_FORMAT(pp_jobs.job_expiry_date,"%m/%d/%y") as expirydate'))
			->orderBY('jobs.created_date', 'DESC')
			->where('jobs.created_by', $userid)	->get();

		return Datatables::of($jobs)
			->addColumn('actions', function ($jobslist) {
				return '<a href="/jobs/edit/'.$jobslist->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deleteJob('.$jobslist->id.');" data-toggle="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash-o"></i></a>
                         <a href="/jobs/appliedjobs/'.$jobslist->id.'"  class="btn btn-xs btn-warning delete_user title="Applied Jobs" data-toggle="tooltip" data-placement="top" title="Applied Jobs"  ><i class="fa fa-th-list"></i></a>
//				return '<a href="/jobs/edit/'.$jobslist->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
//                        <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deleteJob('.$jobslist->id.');" ><i class="fa fa-trash-o"></i></a>


//                         <a href="/appliedjobs/'.$jobslist->id.'" class="btn btn-xs btn-warning"><i class="fa fa-th-list"></i></a>

                    ';
			})

			->make(true);

		return view('careers.jobs', compact('gallerycategories', 'gallerycountries', 'photogallery', 'categoryname', 'title', 'jobs', 'careerscategories', 'careerscountries', 'carrerstypes', 'careersindustry'));
	}
	/****Employeee Dashboard code starts here****/
	public function employeeJobsList() {

		$careerscategories = DB::table('jobs')
			->leftJoin('jobs_categories', 'jobs.job_category', '=', 'jobs_categories.id')
			->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('jobs_categories.category_title', 'jobs_categories.id')

			->get();

		$careersindustry = DB::table('jobs')
			->leftJoin('jobs_categories', 'jobs.job_industry', '=', 'jobs_categories.id')
			->select('jobs_categories.category_title as categoryname', 'jobs_categories.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('jobs_categories.category_title', 'jobs_categories.id')
			->get();
		$careerscountries = DB::table('jobs')
			->leftJoin('us_countries', 'jobs.job_country', '=', 'us_countries.id')
			->select('us_countries.country_name as countryname', 'us_countries.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('us_countries.country_name', 'us_countries.id')
			->get();
		$carrerstypes = DB::table('jobs')
			->leftJoin('carrers_types', 'jobs.job_type', '=', 'carrers_types.id')
			->select('carrers_types.career_type as careertype', 'carrers_types.id as id', DB::raw("ifnull(count('jobs.id'),0) as count"))
			->groupby('carrers_types.career_type', 'carrers_types.id')
			->get();

		$jobs = DB::table('jobs')->select('*')->orderBY('created_date', 'DESC')->where('created_by', '=', Auth::user()->id)->get();

		return view('careers.jobs.employee_jobs', compact('gallerycategories', 'gallerycountries', 'photogallery', 'categoryname', 'title', 'jobs', 'careerscategories', 'careerscountries', 'carrerstypes', 'careersindustry'));
	}

	/***create job code starts here**/
	public function createJob() {
		$categories = DB::table('careers_cats')->select('*')->get();
		$countries  = DB::table('countries')->select('*')->where('id', '!=', '220')->get();
		$types      = DB::table('carrers_types')->select('*')->get();
		$industries = Db::table('jobs_categories')->select('*')->where('parent_id', '=', '0')->where('status', '!=', '0')->get();

		return view('careers.createjob', compact('categories', 'types', 'countries', 'gallerycategories', 'gallerycountries', 'photogallery', 'categoryname', 'title', 'careersindustry', 'industries'));
	}
	/******Edit Job code starts here***/
	public function editJob($id) {

		$categories   = DB::table('careers_cats')->select('*')->get();
		$countries    = DB::table('countries')->select('*')->where('id', '!=', '220')->get();
		$types        = DB::table('carrers_types')->select('*')->get();
		$industries   = Db::table('jobs_categories')->select('*')->where('parent_id', '=', '0')->where('status', '!=', '0')->get();
		$jobs         = DB::table('jobs')->where('id', '=', $id)->first();
		$job_industry = $jobs->job_industry;
		$job_category = $jobs->job_category;

		$categories_jobs    = DB::table('jobs_categories')->select('*')->where('parent_id', '=', $job_industry)->where('status', '=', '1')->get();
		$subcategories_jobs = DB::table('jobs_categories')->select('*')->where('parent_id', '=', $job_category)->where('status', '=', '1')->get();

		return view('careers.jobs.editjob', compact('categories', 'types', 'countries', 'gallerycategories', 'gallerycountries', 'photogallery', 'categoryname', 'title', 'careersindustry', 'industries', 'jobs', 'categories_jobs', 'subcategories_jobs'));

	}

	/****insert jobs code starts here***/
	public function insertJob(Request $request) {
		$req = $request->all();
		if (count($req)) {
			$rule = array(
				'comapnyname'  => 'required',
				'jobtitle'     => 'required',
				'description'  => 'required',
				'type'         => 'required',
				'city'         => 'required',
				'countrie'     => 'required',
				'applynowlink' => 'required',
				'category'     => 'required',
				'subcategory'  => 'required',

			);

			$validator = Validator::make($req, $rule);

			if ($validator          ->fails()) {
				return Redirect::back()->withErrors($validator->messages())->withInput();
			} else {
				$date        = $request->expirydate;
				$dateimplode = explode('/', $date);
				$month       = $dateimplode[0];
				$date        = $dateimplode[1];
				$year        = $dateimplode[2];
				$expirydate  = $year.'-'.$month.'-'.$date;

				$data = array(
					'company_name'        => $req['comapnyname'],
					'job_title'           => $req['jobtitle'],
					'job_description'     => $req['description'],
					'job_type'            => $req['type'],
					'job_city'            => $req['city'],
					'job_state'           => $req['state'],
					'job_country'         => $req['countrie'],
					'job_fax'             => $req['fax'],
					'job_email'           => $req['email'],
					'job_phone'           => $req['phone_no'],
					'job_website_link'    => $req['websitelink'],
					'job_industry'        => $req['industry'],
					'job_category'        => $req['category'],
					'job_subcategory'     => $req['subcategory'],
					'job_requirements'    => $req['job_req'],
					'job_responsibilties' => $req['job_responsibility'],
					'job_benefits'        => $req['job_benifit'],
					'job_applynow_link'   => $req['applynowlink'],
					'job_special_notes'   => $req['job_special_notes'],
					'job_keywords'        => $req['job_keywords'],
					'job_salary'          => $req['salary'],
					'job_experience'      => $req['experience'],
					'created_date'        => date('Y-m-d H:i:s'),
					'job_expiry_date'     => $expirydate,
					'created_by'          => Auth::user()->id,

				);
				$user_meta = Site_model::insert_data('jobs', $data);
				Session::flash('success', 'Job Posted  Successfully.');
				return Redirect::to('/jobs');
				//return view('youtube.list');

			}
		}
		Session::flash('success', 'Unable to add job');
		return view('careers.create');
	}
	/******JObs update code stasrts here***/
	public function updateJob(Request $request) {
		$req = $request->all();
		if (count($req)) {
			$rule = array(
				'comapnyname'  => 'required',
				'jobtitle'     => 'required',
				'description'  => 'required',
				'type'         => 'required',
				'city'         => 'required',
				'countrie'     => 'required',
				'applynowlink' => 'required',
				'category'     => 'required',
				'subcategory'  => 'required',

			);

			$validator = Validator::make($req, $rule);

			if ($validator          ->fails()) {
				return Redirect::back()->withErrors($validator->messages())->withInput();
			} else {
				$date        = $request->expirydate;
				$dateimplode = explode('/', $date);
				$month       = $dateimplode[0];
				$date        = $dateimplode[1];
				$year        = $dateimplode[2];
				$expirydate  = $year.'-'.$month.'-'.$date;

				$data = array(
					'company_name'        => $req['comapnyname'],
					'job_title'           => $req['jobtitle'],
					'job_description'     => $req['description'],
					'job_type'            => $req['type'],
					'job_city'            => $req['city'],
					'job_state'           => $req['state'],
					'job_country'         => $req['countrie'],
					'job_fax'             => $req['fax'],
					'job_email'           => $req['email'],
					'job_phone'           => $req['phone_no'],
					'job_website_link'    => $req['websitelink'],
					'job_industry'        => $req['industry'],
					'job_category'        => $req['category'],
					'job_subcategory'     => $req['subcategory'],
					'job_requirements'    => $req['job_req'],
					'job_responsibilties' => $req['job_responsibility'],
					'job_benefits'        => $req['job_benifit'],
					'job_applynow_link'   => $req['applynowlink'],
					'job_special_notes'   => $req['job_special_notes'],
					'job_keywords'        => $req['job_keywords'],
					'job_salary'          => $req['salary'],
					'job_experience'      => $req['experience'],
					'created_date'        => date('Y-m-d H:i:s'),
					'job_expiry_date'     => $expirydate,
					'created_by'          => Auth::user()->id,

				);
				$condition = array('id' => $req['job_id']);
				$user_meta = Site_model::update_data('jobs', $data, $condition);
				Session::flash('success', 'Job Updated  Successfully.');
				return Redirect::back()->with('message', 'JObs Updated Successfully !');
			}
		}
		Session::flash('fail', 'Job Updation Failed');
		return view('careers.jobs.editjob');

	}
	/****Delete Job Code starts here***/
	public function deleteJobs($id) {
		$condition = array('id' => $id);
		$delete    = Site_model::delete_single('jobs', $condition);
		if ($delete) {
			Session::flash('success', 'Job Deleted Successfully');
		} else {
			Session::flash('fail', 'Unable To delete Careers');
		}

		return redirect('/jobs');
	}

	/****Applied jobs code starts here***/

	public function ajaxCategory() {
		$id      = Input::get('categoryid');
		$results = DB::table('jobs_categories')
			->where('parent_id', '=', $id)
			->get(['id as id', 'category_title as name']);
		return $results;
	}
	/****ajax subcategory based on category code starts here***/
	public function ajaxSubcategory() {

		$id      = Input::get('categoryid');
		$results = DB::table('jobs_categories')
			->where('parent_id', '=', $id)
			->get(['id as id', 'category_title as name']);
		return $results;
	}
	/***Aplly jobs code starts here***/
	public function applyJOb(Request $request) {
		$req = $request->all();

		$resume       = $req['job_message'];
		$uploadresume = $req['new_resume'];
		$old_resume   = $req['old_resume'];
		$userid       = Auth::user()->id;

		if ($uploadresume == "") {
			$resumegetting = $old_resume;

		} else {
			$resumegetting = $uploadresume;
		}
		$data = array(
			'job_id'      => $req['job_id'],
			'job_resume'  => $resumegetting,
			'job_mobile'  => $req['mobile_no'],
			'job_message' => $req['job_message'],
			'user_id'     => Auth::user()->id,
		);
		$user_meta = Site_model::insert_data('applied_jobs', $data);
		Session::flash('success', 'Job Posted  Successfully.');
		return Redirect::to('/jobs');

	}
	/****Applied Jobs Code starts here***/
	public function appliedJobs($id) {
		
		$appliedjobs = DB::table('applied_jobs as a')
			->leftJoin('users as u', 'u.id', '=', 'a.user_id')
			->leftJoin('jobs as j', 'j.id', '=', 'a.job_id')
			->select('j.job_title as jobtitle', 'j.company_name as company', 'job_state as state', 'job_city as city', 'u.fname as name', 'u.email as email', 'u.resume as resume', 'a.id as a_jobid')
			->where('a.job_id', '=', $id)
			->get();
		return view('careers.jobs.applied_jobs', compact('appliedjobs'));
	}
	public function sample(){
		return view('careers.b2b');
	}

}
