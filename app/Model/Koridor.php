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

    public function Point()
    {
        return $this->hasMany('App\Model\Point');
    }
    public function Rute()
    {
        return $this->hasMany('App\Model\Rute');
    }

    public static function opposite($nomor) {
        return $nomor + ($nomor % 2 == 1 ? 1 : -1);
    }
}
