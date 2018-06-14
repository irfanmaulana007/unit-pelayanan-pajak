<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documents;

class StatistikController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function jumlahSurat(){
    	$jumlah = Documents::get()
		    ->groupBy(function($date) {
		    return $date->created_at->month;
		});

		dd($jumlah->count());
    }

    public function jumlahSuratPending(){

    }
}
