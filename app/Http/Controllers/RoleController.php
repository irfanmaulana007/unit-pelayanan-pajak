<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;

class RoleController extends Controller
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
        $role = Roles::get();

        return view('role.index')->with('role', $role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        return view('role.create');
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

        $role = new Roles;
        $role->nama = $nama;
        $role->save();

        $alert = 'Create New Role Successfully !';
        return redirect()->action('RoleController@index')->with('data',[$alert,'success']);
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
        $role = Roles::where('id', $id)->first();

        return view('role.create')
                ->with('id', $id)
                ->with('role', $role);
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

        $role = Roles::where('id', $id)->first();
        $role->nama = $nama;
        $role->save();

        $alert = 'Update Role Successfully !';
        return redirect()->action('RoleController@index')->with('data',[$alert,'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Roles::where('id', $id)->first();
        $role->delete();

        $alert = 'Delete Role Successfully !';
        return redirect()->action('RoleController@index')->with('data',[$alert,'success']);
    }
}
