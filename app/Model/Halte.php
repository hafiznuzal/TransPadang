<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Halte extends Model
{
    //
   	 use SoftDeletes;
     protected $table = 'halte';
     public $timestamps = true;     
     protected $dates = ['deleted_at'];

    public function Point()
    {
        return $this->hasMany('App\Model\Point');
    }      

}
