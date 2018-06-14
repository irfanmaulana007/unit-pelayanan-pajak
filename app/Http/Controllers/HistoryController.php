<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use Auth;
use DB;

class HistoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
    	// $transaction = Transactions::where('id_user', Auth::user()->id)->get();
    	$transaction = DB::table('transactions')
    						->select('transactions.id_document','transactions.id_user','transactions.send_to','transactions.created_at','documents.kode','documents.nama','users.nama as user')
    						->join('documents','documents.id','=','transactions.id_document')
    						->join('users','users.id','=','transactions.send_to')
    						->where('id_user', Auth::user()->id)
    						->get();

    	return view('history.index')->with('transaction', $transaction);
    }
}
