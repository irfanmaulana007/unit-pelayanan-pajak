<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents';
    protected $fillable = [
    	'id_document_status','kode','nama','asal','perihal','tanggal_masuk','tanggal_terima','nama_pemeriksa'
    ];
}
