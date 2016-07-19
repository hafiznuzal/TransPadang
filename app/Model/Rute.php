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
    public static function basisdata_rute($id)
    {
        $tmp = static::where('id','>',0)
                ->distinct()->get(); 
        return $tmp;
    }
     public static function delete_rute($id)
    {
        $tmp = static::find($id)          
                ->delete();
        return $tmp;
    }

}
