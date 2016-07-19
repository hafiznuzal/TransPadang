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

    public function Relasi()
    {
        return $this->belongsTo('App\Model\Halte', 'relasi');
    }

    public static function basisdata_halte($id)
    {
        $tmp = static::where('id','>',0)
                ->distinct()->get();       
                
        return $tmp;
    }
    public static function delete_halte($id)
    {
        $tmp = static::find($id)          
                ->delete();
        return $tmp;
    }

}
