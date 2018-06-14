<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documents;
use App\User;
use DB;

class StatistikController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $doc = [];
        for($i = 1; $i <= 12; $i++){
            $totalDocument = Documents::selectRaw('count(*) as val')
                                    ->whereMonth('created_at','=', $i)
                                    ->first();

            array_push($doc, $totalDocument->val);
        }
        // dd($doc);

        // $user = User::get();
        $user = DB::table('users')
                    ->select('users.id_role','users.pending','roles.nama as role')
                    ->join('roles','roles.id','=','users.id_role')
                    ->get();

        return view('statistik.index')
                ->with('doc', $doc)
                ->with('user', $user);
    }

    public function jumlahSuratPending(){

    }
}
