<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documents;
use App\Roles;
use App\User;
use App\DocumentStatus;
use App\Companies;
use App\Transactions;
use Auth;
use DB;

class DocumentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function monitoring(){
        if(Auth::user()->id_role != 1){
            return redirect('document/input');
        }else{
            $document = Documents::get();
            $document = DB::table('documents')
                                ->select('documents.id','documents.kode','documents.nama','documents.tanggal_terima','documents.asal','documents.perihal','document_status.nama as status')
                                ->join('document_status','document_status.id','=','documents.id_document_status')
                                ->get();

            return view('monitoring')->with('document', $document);
        }
    }

    public function findKode($kode){
        $document = Documents::where('kode', $kode)->first();

        if(is_null($document)){
            $param['document'] = 'false';
        }else{
            $transaction = Transactions::where('id_document', $document->id)->orderby('id','desc')->first();

            $param['id'] = $document->id;
            $param['document'] = 'true';
            $param['nama'] = $document->nama;
            $param['asal'] =  $document->asal;
            $param['perihal'] = $document->perihal;
            $param['tanggal'] = $document->tanggal_masuk;
            $param['uraian'] = $document->uraian_hasil;

            if($transaction->send_to == Auth::user()->id && $document->id_document_status == 2){
                $param['input'] = 'false';
                $param['receiveAble'] =  'true';
            }else if($transaction->send_to == Auth::user()->id && $document->id_document_status == 4){
                $param['input'] = 'true';
                $param['receiveAble'] =  'false';
            }else{
                $param['input'] = 'false';
                $param['receiveAble'] =  'false';
            }

        }
        $data = (array) $param;

        return response()->json($data);
    }

    public function input(){
        $company = Companies::get();
        $user = User::get();
        $documentStatus = DocumentStatus::where('id', 1)->orWhere('id', 6)->get();

        return view('transaction.input')
                ->with('company', $company)
                ->with('user', $user)
                ->with('documentStatus', $documentStatus);
    }

    public function createInput(Request $request){
        $kode = $request->input('kode');
        $nama = $request->input('nama');
        $asal = $request->input('asal');
        $perihal = $request->input('perihal');
        $tanggal = $request->input('tanggal');
        $kirim = $request->input('kirim');
        $status = 2;// 2 = document sent
        $uraian = $request->input('uraian');

        $document = new Documents();
        $document->id_document_status = $status;
        $document->kode = $kode;
        $document->nama = $nama;
        $document->asal = $asal;
        $document->perihal = $perihal;
        $document->tanggal_masuk = $tanggal;
        $document->uraian_hasil = $uraian;
        $document->tanggal_terima = $tanggal;
        $document->nama_pemeriksa = '';
        $document->save();

        $transaction = new Transactions();
        $transaction->id_document = $document->id;
        $transaction->id_user = Auth::user()->id;
        $transaction->send_to = $kirim;
        $transaction->save();


        $alert = 'Input Document Successfully !';
        return redirect()->action('DocumentController@input')->with('data',[$alert,'success']);
    }

    public function receiveDocument($id){
        $document = Documents::where('id', $id)->first();
        $document->id_document_status = 4; // 4 = document received
        $document->save();

        $alert = 'Receive Document Successfully !';
        return redirect()->action('DocumentController@input')->with('data',[$alert,'success']);
    }

    public function passingDocument(Request $request, $id){
        $transaction = new Transactions();
        $transaction->id_document = $id;
        $transaction->id_user = Auth::user()->id;
        $transaction->send_to = $request->input('kirim');
        $transaction->save();

        $document = Documents::where('id', $id)->first();
        $document->id_document_status = 2; // 2 = document sent
        $document->save();

        $alert = 'Kirim Dokumen Berhasil !';
        return redirect()->action('DocumentController@input')->with('data',[$alert,'success']);
    }

    public function deleteDocument($id){
        $document = Documents::where('id', $id)->first();
        $document->delete();

        $alert = 'Delete Document Successfully !';
        return redirect()->action('DocumentController@monitoring')->with('data',[$alert,'success']);
    }

}
