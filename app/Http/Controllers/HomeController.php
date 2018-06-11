<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documents;
use Auth;

class HomeController extends Controller
{

	public function index(){
		if(!Auth::user()){
            return redirect()->action('AuthController@login');
        }else{
			return redirect()->action('HomeController@monitoring');
        }
	}

	public function monitoring(){
		$document = Documents::get();

		return view('monitoring')->with('document', $document);
	}
}
