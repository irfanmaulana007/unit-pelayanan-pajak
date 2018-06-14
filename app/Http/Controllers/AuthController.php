<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
	public function login(){
		return view('auth.login');
	}

	public function doLogin(Request $request){
		$nip = $request->input('nip');
		$password = $request->input('password');
        Auth::attempt(['nip' => $nip, 'password' => $password]);
        if (Auth::check()) {
            return redirect()->action('HomeController@index');
        }else{
	        $alert = 'Invalid NIP or password!';
	        return redirect()->action('AuthController@login')->with('data',[$alert,'danger']);
        }
	}

	public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
