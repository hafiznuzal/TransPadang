<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    //
    use SoftDeletes;
     protected $table = 'kelurahan';
     public $timestamps = true;     
     protected $dates = ['deleted_at'];

     public function Koridor()
    {
        return $this->hasMany('Koridor');
    }

     public function Kecamatan()
    {
        return $this->belongsTo('Kecamatan');
    }
}