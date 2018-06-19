<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use App\Documents;
use App\User;
use DB;
use Carbon;

class TransactionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function monitoring(){
        $transaction = DB::table('transactions')
                            ->select('transactions.id','documents.kode','documents.nama','documents.tanggal_terima','documents.asal','documents.perihal','users.id_role','transactions.send_to','documents.id_document_status','roles.nama as role','users.nama as user')
                            ->join('documents','documents.id','=','transactions.id_document')
                            ->join('users','users.id','=','transactions.send_to')
                            ->join('roles','roles.id','=','users.id_role')
                            ->get();

        return view('monitoring')->with('transaction', $transaction);
    }

    public function findTransaction($id){
        $transaction = DB::table('transactions')
                            ->select('transactions.id','documents.kode','documents.nama','documents.tanggal_terima','documents.asal','documents.perihal','users.id_role','transactions.send_to','Documents.id_document_status','transactions.uraian_hasil','users.nama as user','document_status.nama as status')
                            ->join('documents','documents.id','=','transactions.id_document')
                            ->join('users','users.id','=','transactions.id_user')
                            ->join('document_status','document_status.id','=','documents.id_document_status')
                            ->where('transactions.id', $id)
                            ->first();

        $data = [
            'transaction' => 'true',
            'kode' => $transaction->kode,
            'nama' => $transaction->nama,
            'asal' => $transaction->asal,
            'pemeriksa' => $transaction->user,
            'perihal' => $transaction->perihal,
            'status' => $transaction->status,
            'tanggal' => $transaction->tanggal_terima,
            'uraian' => $transaction->uraian_hasil,
        ];

        return response()->json($data);
    }

    public function detailTransaction($id){
        $transaction = DB::table('transactions')
                            ->select('transactions.id','documents.kode','documents.nama','documents.tanggal_terima','documents.asal','documents.perihal','users.id_role','transactions.send_to','Documents.id_document_status','transactions.uraian_hasil','users.nama as user','document_status.nama as status')
                            ->join('documents','documents.id','=','transactions.id_document')
                            ->join('users','users.id','=','transactions.id_user')
                            ->join('document_status','document_status.id','=','documents.id_document_status')
                            ->where('transactions.id_document', $id)
                            ->first();

        $detail = DB::table('transactions')
                            ->select('transactions.id_user','transactions.send_to','transactions.created_at','a.nama as nama_asal','b.nama as nama_tujuan','transactions.uraian_hasil')
                            ->join('users as a','a.id','=','transactions.id_user')
                            ->join('users as b','b.id','=','transactions.send_to')
                            ->where('transactions.id_document', $id)
                            ->get();

        return view('partial.detail-monitoring')
        		->with('transaction', $transaction)
        		->with('detail', $detail);
    }

    public function deleteTransaction($id){
        $document = Documents::where('id', $id)->first();
        $document->delete();

        $alert = 'Delete Document Successfully !';
        return redirect()->action('DocumentController@monitoring')->with('data',[$alert,'success']);
    }

    public function checkPendingDocument(){
        $date = date("Y-m-d H:i:s");
        $date = date("Y-m-d", strtotime('-3 days', strtotime($date)));

        $arrId = [];
        $arrUser = [];
        $document = Documents::where('id_document_status' ,'!=', '1')->get();
        foreach($document as $key => $value){
            $transaction = Transactions::where('id_document', $value->id)->orderBy('id', 'desc')->first();
            if($transaction->created_at < $date){
                array_push($arrId, $transaction->id_document);
                array_push($arrUser, $transaction->send_to);
            }

        }

        foreach($arrId as $key => $value){
            $document = Documents::where('id', $value)->first();
            $document->id_document_status = 5;
            $document->save();
        }
        foreach($arrUser as $key => $value){
            $user = User::where('id', $value)->first();
            $user->pending = $user->pending + 1;
            $user->save();
        }
    }
	
}
