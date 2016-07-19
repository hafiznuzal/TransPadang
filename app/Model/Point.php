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
        return $this->belongsTo('App\Model\Halte');
    }
    
    public function Koridor()
    {
        return $this->belongsTo('App\Model\Koridor');
    }
    /*
        Mendapatkan database dari koridor
    */

     public static function basisdata_point($id)
    {
        $tmp = static::where('koridor_id',$id)                
                ->orderBy('nomor', 'asc')
                ->get();
        return $tmp;
    }

    

     public static function update_nomor_poin($id)
    {
        $tmp = static::where('koridor_id', $id->koridor_id)                
                ->orderBy('nomor', 'asc')
                ->get();
        return $tmp;
    }

     public static function delete_poin($id)
    {
        $tmp = static::find($id)          
                ->delete();
        return $tmp;
    }

     public static function jumlah_point($id,$nomor)
    {
        $tmp = static::where('koridor_id',$id)  
                ->where('nomor', '>=', $nomor)              
                ->count();
        return $tmp;
    }

     public static function point_sementara($id,$nomor)
    {
        $tmp = static::where('koridor_id',$id)  
                ->where('nomor',$nomor)              
                ->first();
        return $tmp;
    }

    /**
     * Mendapatkan jalan diantara dua point yang koridor sama dan searah
     * @param Point awal
     * @param Point akhir
     * @return Collection point jalan
     */
    public static function jalan_antara($point_awal, $point_akhir)
    {
        $tmp = static::where('koridor_id', $point_awal->koridor_id)
                ->where('nomor', '>=', $point_awal->nomor)
                ->where('nomor', '<=', $point_akhir->nomor)
                ->orderBy('nomor', 'asc')
                ->get();
        return $tmp;
    }

    /**
     * Mendapatkan jalan diantara dua point yang koridor beda
     * @param Point awal
     * @param Point akhir
     * @return Collection point jalan
     */
    public static function jalan_seberang($point_awal, $point_akhir)
    {
        $tmp = static::where('koridor_id', $point_awal->koridor_id)
                ->where('nomor', '>=', array($point_awal->nomor))
                ->orderBy('nomor', 'asc')
                ->get();
        $jalan = $tmp;

        $tmp = static::where('koridor_id', $point_akhir->koridor_id)
                ->where('nomor', '<=', array($point_akhir->nomor))
                ->orderBy('nomor', 'asc')
                ->get();
        $jalan = $jalan->merge($tmp);
        return $jalan;
    }

    /**
     * Mendapatkan jalan diantara dua point yang koridor sama dan berlawan arah
     * @param Point awal
     * @param Point akhir
     * @return Collection point jalan
     */
    public static function jalan_mundur($point_awal, $point_akhir)
    {
        $tmp = static::where('koridor_id', $point_awal->koridor_id)
                ->where('nomor', '>=', array($point_awal->nomor))
                ->orderBy('nomor', 'asc')
                ->get();
        $jalan = $tmp;

        $tmp = static::where('koridor_id', Koridor::opposite($point_awal->koridor_id))
                ->orderBy('nomor', 'asc')
                ->get();
        $jalan = $jalan->merge($tmp);

        $tmp = static::where('koridor_id', $point_akhir->koridor_id)
                ->where('nomor', '<=', array($point_akhir->nomor))
                ->orderBy('nomor', 'asc')
                ->get();
        $jalan = $jalan->merge($tmp);
        return $jalan;
    }
}
