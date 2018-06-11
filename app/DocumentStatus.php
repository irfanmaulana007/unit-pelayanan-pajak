<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentStatus extends Model
{
    protected $table = 'document_status';
    protected $fillable = [
    	'nama'
    ];
}
