<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use DB;
use Auth;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')
                            ->select('users.id','users.nama','users.nip','users.email','roles.nama as role','users.created_at')
                            ->join('roles','roles.id','=','users.id_role')
                            ->get();

        return view('user.index')->with('user', $user);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Roles::get();

        return view('user.create')->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = $request->input('nama');
        $nip = $request->input('nip');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $role = $request->input('position');

        $user = new User;
        $user->id_role = $role;
        $user->nama = $nama;
        $user->nip = $nip;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        $alert = 'Create New User Successfully !';
        return redirect()->action('UserController@index')->with('data',[$alert,'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Roles::get();
        $user = User::where('id', $id)->first();

        return view('user.create')
                ->with('id', $id)
                ->with('role', $role)
                ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nama = $request->input('nama');
        $nip = $request->input('nip');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $role = $request->input('position');

        $user = User::where('id', $id)->first();
        $user->id_role = $role;
        $user->nama = $nama;
        $user->nip = $nip;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        $alert = 'Update User Successfully !';
        return redirect()->action('UserController@index')->with('data',[$alert,'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();

        $alert = 'Delete User Successfully !';
        return redirect()->action('UserController@index')->with('data',[$alert,'success']);
    }
}
