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
}
