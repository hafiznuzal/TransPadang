<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Koridor extends Model
{

	use SoftDeletes;
	protected $table = 'koridor';
	public $timestamps = true;     
	protected $dates = ['deleted_at'];

    public function Halte()
    {
        return $this->hasMany('Halte');
    }

     public function Kelurahan()
    {
        return $this->belongsTo('Kelurahan');
    }
}
