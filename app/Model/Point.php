<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes;
     protected $table = 'point';
     public $timestamps = true;     
     protected $dates = ['deleted_at'];//

     public function Halte()
    {
        return $this->belongsTo('Halte');
    }
     public function Koridor()
    {
        return $this->belongsTo('Koridor');
    }
}
