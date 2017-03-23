<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

class HomePageController extends Controller {

	public function index()
	{
		return view('frontend.index');
	}
	
}
