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

    public function koridorAsal()
    {
        return $this->belongsTo('App\Model\Koridor', 'koridor_asal');
    }
    public function koridorTujuan()
    {
        return $this->belongsTo('App\Model\Koridor', 'koridor_tujuan');
    }
    public function halteTransisi()
    {
        return $this->belongsTo('App\Model\Halte', 'halte_transisi');
    }

}
