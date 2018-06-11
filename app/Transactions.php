<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
    	'id_document','id_user','tanggal_proses','send_to'
    ];
}
