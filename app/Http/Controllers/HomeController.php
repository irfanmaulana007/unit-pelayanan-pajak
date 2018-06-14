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
        	if(Auth::user()->id_role == 1){ // 1 = Tata Usaha
				return redirect()->action('DocumentController@monitoring');
        	}else{
				return redirect()->action('DocumentController@input');
        	}
        }
	}

	public function monitoring(){
		$document = Documents::get();

		return view('monitoring')->with('document', $document);
	}
}
