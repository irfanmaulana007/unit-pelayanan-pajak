<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentStatus;

class DocumentStatusController extends Controller
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
        $documentStatus = DocumentStatus::get();

        return view('document-status.index')->with('documentStatus', $documentStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document-status.create');
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

        $documentStatus = new DocumentStatus;
        $documentStatus->nama = $nama;
        $documentStatus->save();

        $alert = 'Create New Document Status Successfully !';
        return redirect()->action('DocumentStatusController@index')->with('data',[$alert,'success']);
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
        $documentStatus = DocumentStatus::where('id', $id)->first();

        return view('document-status.create')
                ->with('id', $id)
                ->with('documentStatus', $documentStatus);
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

        $documentStatus = DocumentStatus::where('id', $id)->first();
        $documentStatus->nama = $nama;
        $documentStatus->save();

        $alert = 'Update Document Status Successfully !';
        return redirect()->action('DocumentStatusController@index')->with('data',[$alert,'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentStatus = DocumentStatus::where('id', $id)->first();
        $documentStatus->delete();

        $alert = 'Delete Document Status Successfully !';
        return redirect()->action('DocumentStatusController@index')->with('data',[$alert,'success']);
    }
}
