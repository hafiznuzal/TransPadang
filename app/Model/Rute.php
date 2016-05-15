<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rute extends Model
{
    //
    use SoftDeletes;
     protected $table = 'kelurahan';
     public $timestamps = true;     
     protected $dates = ['deleted_at'];

     public function Point()
    {
        return $this->belongsToMany('Point');
    }

}
