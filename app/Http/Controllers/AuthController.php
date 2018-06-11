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

	public function register(){
		return view('auth.register');
	}

	public function doRegister(Request $request){
		$nama = $request->input('nama');
		$nip = $request->input('nip');
		$email = $request->input('email');
		$password = bcrypt($request->input('password'));

		$user = new User;
		$user->id_role = 1;
		$user->nama = $nama;
		$user->nip = $nip;
		$user->email = $email;
		$user->password = $password;
		$user->save();

        $alert = 'Register Successfully !';
        return redirect()->action('AuthController@register')->with('data',[$alert,'success']);
	}

	public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
