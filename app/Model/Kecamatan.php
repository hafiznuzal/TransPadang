<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use SoftDeletes;
     protected $table = 'kecamatan';
     public $timestamps = true;     
     protected $dates = ['deleted_at'];//

     public function Kelurahan()
    {
        return $this->hasMany('Kelurahan');
    }
}
