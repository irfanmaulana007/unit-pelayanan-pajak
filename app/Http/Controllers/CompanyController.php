<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;

class CompanyController extends Controller
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
        $company = Companies::get();

        return view('company.index')->with('company', $company);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        return view('company.create');
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
        $alamat = $request->input('alamat');
        $phone = $request->input('phone');

        $company = new Companies;
        $company->nama = $nama;
        $company->alamat = $alamat;
        $company->phone = $phone;
        $company->save();

        $alert = 'Create New Company Successfully !';
        return redirect()->action('CompanyController@index')->with('data',[$alert,'success']);
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
        $company = Companies::where('id', $id)->first();

        return view('company.create')
                ->with('id', $id)
                ->with('company', $company);
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
        $alamat = $request->input('alamat');
        $phone = $request->input('phone');

        $company = Companies::where('id', $id)->first();
        $company->nama = $nama;
        $company->alamat = $alamat;
        $company->phone = $phone;
        $company->save();

        $alert = 'Update Company Successfully !';
        return redirect()->action('CompanyController@index')->with('data',[$alert,'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Companies::where('id', $id)->first();
        $company->delete();

        $alert = 'Delete Company Successfully !';
        return redirect()->action('CompanyController@index')->with('data',[$alert,'success']);
    }
}
