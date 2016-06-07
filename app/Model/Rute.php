<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Rute extends Model
{
    //
   	 use SoftDeletes;
     protected $table = 'rute';
     public $timestamps = true;     
     protected $dates = ['deleted_at'];

    public function koridor_asal()
    {
        return $this->belongsTo('App\Model\Koridor');
    }
    public function koridor_tujuan()
    {
        return $this->belongsTo('App\Model\Koridor');
    }


}
