<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Halte;
use App\Model\Koridor;
use App\Model\Point;
use App\Model\Rute;

class HomeController extends Controller
{
	public function index()
    {
    	return view('index');	
    }
    public function koridor()
    {
    	return view('information-koridor');	
    }
    public function jadwal()
    {
    	return view('informasi-jadwal');	
    }
    public function testline()
    {
        return view('test-line');    
    }

    public function ungroup()
    {
        return view('test_ungroup');    
    }
    public function koridor_all()
    {
        return view('koridor_all');    
    }
    public function k_all()
    {
        return view('k_all');    
    }

    public function k1()
    {
        return view('k1');    
    }
     public function k2()
    {
        return view('k2');    
    }
     public function k3()
    {
        return view('k3');    
    }
     public function k5()
    {
        return view('k5');    
    }
     public function k6()
    {
        return view('k6');    
    }


    public function halte_form()
    {
       
        $halte = Halte::where('id','>',0)->get();
        // print_r($halte);
        return view("index")->with('halte',$halte);

       
        // return json_encode($halte);
    }

    public function halte()
    {
        $FeatureCollection = array();
        $FeatureCollection['type'] = "FeatureCollection";
        $FeatureCollection['crs'] = array();
        $FeatureCollection['crs']['type'] = "name";
        $FeatureCollection['crs']['properties'] = array();
        $FeatureCollection['crs']['properties']['name'] = "urn:ogc:def:crs:OGC:1.3:CRS84";
        $FeatureCollection['features'] = array();

        // $where = array('koridor_id' => 1);
        // $
        $halte = Point::with('Koridor')-> where('halte_id','>',0)->
        get();
        // return json_encode($halte);
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['properties'] = array();
            $feature['properties']['name'] = $value->nama;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            $feature['properties']['line'] = $value->koridor->line;
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            
            array_push($FeatureCollection['features'], $feature);
        }
        return json_encode($FeatureCollection);
    }

    /**
     * Dapetin jalan yang menghubungkan titik halte awal dan halte akhir. Algoritmanya:
     * dapetin halte awal dan halte akhir.
     * Masuk ke perulangan, sampai halte asal = halte tujuan
     */
    public function pencarian_optimal($awal, $akhir)
    {
        /* dapetin objek halte */
        $halte_awal = Halte::find($awal);
        $halte_akhir = Halte::find($akhir);
        if ($awal == $akhir) {
            return json_encode($halte_awal);
        }
        $halte_asal = $halte_awal;
        $halte_tujuan = $halte_akhir;

        $jalan = new Collection;
        $halte_perpindahan = array();
        while ($halte_asal != $halte_tujuan) {
            /* dapetin objek poin, 1 halte bisa jadi ada byk point. pilih slh 1 */
            $point_awals = $halte_asal->Point;
            $point_akhirs = $halte_tujuan->Point;
            $point_awal = null;
            $point_akhir = null;
            if (count($point_awals) == 1) {
                $point_awal = $point_awals[0];
            }
            if (count($point_akhirs) == 1) {
                $point_akhir = $point_akhirs[0];
            }
            /* Jika poin awal ada banyak, pilih yg sama dgn poin akhir */
            if ($point_awal == null && $point_akhir != null) {
                foreach ($point_awals as $val) {
                    if ($point_akhir->koridor_id == $val->koridor_id) {
                        $point_awal = $val;
                        break;
                    } else if ($point_akhir->Koridor->nomor == $val->Koridor->nomor) {
                        $point_awal = $val;
                    }
                }
                if ($point_awal == null) {
                    $point_awal = $point_awals[0];
                }
            }
            /* Jika poin akhir ada banyak, pilih yg sama dgn poin awal */
            if ($point_akhir == null && $point_awal != null) {
                foreach ($point_akhirs as $val) {
                    if ($point_awal->koridor_id == $val->koridor_id) {
                        $point_akhir = $val;
                        break;
                    } else if ($point_awal->Koridor->nomor == $val->Koridor->nomor) {
                        $point_akhir = $val;
                    }
                }
                if ($point_akhir == null) {
                    $point_akhir = $point_akhirs[0];
                }
            }
            /* Jika poin awal dan poin akhir sama sama banyak, pilih yg koridornya sama */
            if ($point_awal == null && $point_akhir == null) {
                foreach ($point_awals as $iw) {
                    foreach ($point_akhirs as $ik) {
                        if ($iw->koridor_id == $ik->koridor_id) {
                            $point_awal = $iw;
                            $point_akhir = $ik;
                            break;
                        } else if ($iw->Koridor->nomor == $ik->Koridor->nomor) {
                            $point_awal = $iw;
                            $point_akhir = $ik;
                        }
                    }
                }
                if ($point_awal == null && $point_akhir == null) {
                    $point_awal = $point_awals[0];
                    $point_akhir = $point_akhirs[0];
                }
            }
            $jalan->push($point_awal);

            $nyebrang_asal = false;
            $nyebrang_tujuan = false;
            $nyebrang_poin_asal = false;
            $nyebrang_poin_tujuan = false;

            // dd($point_awal, $point_akhir);
            /* ************ MULAI NYARI JALAN ************ */
            /* Jika koridor aslinya sama, tinggal go aja, ga pake ganti ganti bis */
            if ($point_awal->Koridor->nomor == $point_akhir->Koridor->nomor) {
                /* Jika koridor sama */
                if ($point_awal->koridor_id == $point_akhir->koridor_id) {

                    /* Nomor poin awal itu sesudah nomor poin akhir */
                    if ($point_awal->nomor < $point_akhir->nomor) {
                        $tmp = Point::jalan_antara($point_awal, $point_akhir);
                        $jalan = $jalan->merge($tmp);
                    }
                    /* Nomor poin awal itu sblm nomor poin akhir */
                    else if ($point_awal->nomor > $point_akhir->nomor) {
                        if ($halte_asal->Relasi != null && $halte_tujuan->Relasi != null) {
                            $halte_asal = $halte_asal->Relasi;
                            $nyebrang_asal = !$nyebrang_asal;
                            $point_awal = $halte_asal->Point->first();
                            $halte_tujuan = $halte_tujuan->Relasi;
                            $nyebrang_tujuan = !$nyebrang_tujuan;
                            $point_akhir = $halte_tujuan->Point->first();

                            $tmp = Point::jalan_antara($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        } else if ($halte_asal->Relasi != null) {
                            $halte_asal = $halte_asal->Relasi;
                            $nyebrang_asal = !$nyebrang_asal;
                            $point_awal = $halte_asal->Point->first();

                            $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        } else if ($halte_tujuan->Relasi != null) {
                            $halte_tujuan = $halte_tujuan->Relasi;
                            $nyebrang_tujuan = !$nyebrang_tujuan;
                            $point_akhir = $halte_tujuan->Point->first();

                            $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        } else {
                            $tmp = Point::jalan_mundur($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        }
                    }
                }
                /* Jika koridor beda */
                else {
                    if ($halte_asal->Relasi == null && $halte_tujuan->Relasi == null) {
                        $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                        $jalan = $jalan->merge($tmp);
                    } else {
                        /* Samain dulu koridornya */
                        if ($halte_asal->Relasi != null) {
                            $halte_asal = $halte_asal->Relasi;
                            $nyebrang_asal = !$nyebrang_asal;
                            $point_awal = $halte_asal->Point->first();
                        } else if ($halte_tujuan->Relasi != null) {
                            $halte_tujuan = $halte_tujuan->Relasi;
                            $nyebrang_tujuan = !$nyebrang_tujuan;
                            $point_akhir = $halte_tujuan->Point->first();
                        }

                        /* Nomor poin awal itu sesudah nomor poin akhir */
                        if ($point_awal->nomor < $point_akhir->nomor) {
                            $tmp = Point::jalan_antara($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        }
                        /* Nomor poin awal itu sblm nomor poin akhir */
                        else if ($point_awal->nomor > $point_akhir->nomor) {
                            if ($halte_asal->Relasi != null && $halte_tujuan->Relasi != null) {
                                $halte_asal = $halte_asal->Relasi;
                                $nyebrang_asal = !$nyebrang_asal;
                                $point_awal = $halte_asal->Point->first();
                                $halte_tujuan = $halte_tujuan->Relasi;
                                $nyebrang_tujuan = !$nyebrang_tujuan;
                                $point_akhir = $halte_tujuan->Point->first();

                                $tmp = Point::jalan_antara($point_awal, $point_akhir);
                                $jalan = $jalan->merge($tmp);
                            } else if ($halte_asal->Relasi != null) {
                                $halte_asal = $halte_asal->Relasi;
                                $nyebrang_asal = !$nyebrang_asal;
                                $point_awal = $halte_asal->Point->first();

                                $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                                $jalan = $jalan->merge($tmp);
                            } else if ($halte_tujuan->Relasi != null) {
                                $halte_tujuan = $halte_tujuan->Relasi;
                                $nyebrang_tujuan = !$nyebrang_tujuan;
                                $point_akhir = $halte_tujuan->Point->first();

                                $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                                $jalan = $jalan->merge($tmp);
                            } else {
                                $tmp = Point::jalan_mundur($point_awal, $point_akhir);
                                $jalan = $jalan->merge($tmp);
                            }
                        }
                    }
                }
                $halte_asal = $halte_tujuan;
                $halte_tujuan = $halte_akhir;
            } else {
                $route = Rute::where('koridor_asal', $point_awal->koridor_id)
                        ->where('koridor_tujuan', $point_akhir->koridor_id)
                        ->first();
                $halte_transisi = $route->halteTransisi;
                $halte_tujuan = $halte_transisi;
                // dd(compact('halte_asal', 'halte_tujuan'));
            }
        }

        $poins = array();
        $list_halte = array();
        $temp = null; // ini buat hapus poin yg dobel2.
        foreach ($jalan as $key => $value) {
            if ($temp != null && $value == $temp) {
                unset($jalan[$key]);
                continue;
            }
            $temp = $value;
            if ($value->koridor_id > 0) {
                $list_halte[] = $value;
            }
            $poin = array();
            array_push($poin, $value->latitude);
            array_push($poin, $value->longitude);
            
            array_push($poins, $poin);
        }

        // dd($jalan);
        echo json_encode(compact('poins', 'jalan'));
        exit();

        $dd = compact('point_awal', 'point_akhir', 'koridor_awal', 'koridor_akhir', 'halte_awal', 'halte_akhir');
        dd($dd);
    }

    public function perpindahan_halte($awal, $akhir)
    {
        $route = Rute::where('koridor_asal', $point_awal->koridor_id)
                ->where('koridor_tujuan', $point_akhir->koridor_id)
                ->first();
        $halte_transisi = $route->halteTransisi;
    }

    public function pencarian($awal,$akhir)
    {
      // $FeatureCollection = array();        
      
        // $where_brgkt = array('halte_id' => $awal);
        // $halte_keberangkatan = Point::with('Koridor')->where($where_brgkt)->first();
        // $where_dtg = array('halte_id' => $akhir);
        // $halte_kedatangan = Point::with('Koridor')->where($where_dtg)->first();
           // return json_encode($rute);

        $keberangkatan = array();
        $kedatangan = array();
        $halte_transisi = array();
        $via= array();


        $hasil = array();
        $hasil['berangkat'][0] = $awal;
        $hasil['kedatangan'][0] = $akhir;
       
        $poins = array();


        $where = array('halte_id' => $awal);
        $temp = Point::where($where)->first();
        $koridor_awal = $temp->koridor_id;

        $where = array('halte_id' => $akhir);
        $temp = Point::where($where)->first();
        $koridor_akhir = $temp->koridor_id;
        $nomor_akhir = $temp->nomor;


        $temp_asal = $koridor_awal;
        $tujuan_akhir = $koridor_akhir;

        $where = array('halte_id' => $awal);
        $temp = Point::where($where)->first();
        $temp_start = $temp->nomor;
        // for ($i=0; $i < 10 ; $i++) 
        // {   
        //     $where_brgkt = array('koridor_asal' => $temp_asal);
        //     $where_dtg = array('koridor_tujuan' => $tujuan_akhir = $akhir);

        //     $cari = Rute::where($where_brgkt)->where($where_dtg)->first();
        //     $temp_asal = $cari->koridor_via;
        //     $hasil['berangkat'][$i] = $cari->koridor_asal;
        //     $hasil['kedatangan'][$i] = $cari->koridor_tujuan;
        //     $hasil['via'][$i] = $cari->koridor_via;
        //     $hasil['halte'][$i] = $cari->halte_transisi;

        //     if ($hasil['via'][$i] == 0) break;  
        //     // $keberangkatan[$i] = $halte_keberangkatan->koridor_id;
        //     // $halte = Rute::where('id' => $awal)->get();
        // }

        $temp_start = $awal;
        // print_r($koridor_awal." ".$koridor_akhir." ".$awal." ".$akhir);
        while(1)
        {   $halte_transisi = Point::where('koridor_id',$koridor_awal)->where('halte_id',$temp_start)->first();
            
            if($koridor_awal==$koridor_akhir){
                $halte_akhir = Point::where('koridor_id',$koridor_awal)->where('halte_id',$akhir)->first();
                $poin = Point::where('koridor_id',$koridor_awal)->whereBetween('nomor',array($halte_transisi->nomor,$halte_akhir->nomor))->get();
                
            }
            else $poin = Point::where('koridor_id',$koridor_awal)->where('nomor','>=',$halte_transisi->nomor)->get();
            foreach ($poin as $key => $value) {
                $coordinates = array();
                array_push($coordinates, $value->latitude);
                array_push($coordinates, $value->longitude);
                array_push($poins,$coordinates);
            }
            if($koridor_awal == $koridor_akhir){
                
                break;
            }
            $next = Rute::where('koridor_asal',$koridor_awal)->where('koridor_tujuan',$koridor_akhir)->first();
            $temp_start = $next->halte_transisi;
            $koridor_awal = $next->koridor_via;
            if($koridor_awal==0){
                $koridor_awal = $next->koridor_tujuan;
            }

        }
        // print_r($poins);
        // $hasil['asal'] = $cari->koridor_asal;        
        // $hasil['tujuan'] = $cari->koridor_tujuan;
        // $hasil['via'] = $cari->koridor_via;
        // $hasil['halte'] = $cari->halte_transisi;
        
        return json_encode($poins);
    }

     public function pencarian_nyebrang($awal,$akhir)
    {
      

        $keberangkatan = array();
        $kedatangan = array();
        $halte_transisi = array();
        $via= array();


        $hasil = array();
        $hasil['berangkat'][0] = $awal;
        $hasil['kedatangan'][0] = $akhir;
       
        $poins = array();


        $where = array('halte_id' => $awal);
        $temp = Point::where($where)->first();
        $koridor_awal = $temp->koridor_id;

        $where = array('halte_id' => $akhir);
        $temp = Point::where($where)->first();
        $koridor_akhir = $temp->koridor_id;
        $nomor_akhir = $temp->nomor;


        $temp_asal = $koridor_awal;
        $tujuan_akhir = $koridor_akhir;

        $where = array('halte_id' => $awal);
        $temp = Point::where($where)->first();
        $temp_start = $temp->nomor;
        

        $temp_start = $awal;
       
        while(1)
        {   
            $halte_transisi = Point::where('koridor_id',$koridor_awal)->where('halte_id',$temp_start)->first();
            
            if($koridor_awal==$koridor_akhir){
                $halte_akhir = Point::where('koridor_id',$koridor_awal)->where('halte_id',$akhir)->first();
                $poin = Point::where('koridor_id',$koridor_awal)->whereBetween('nomor',array($halte_transisi->nomor,$halte_akhir->nomor))->get();
                
            }
            else $poin = Point::where('koridor_id',$koridor_awal)->where('nomor','>=',$halte_transisi->nomor)->get();
            foreach ($poin as $key => $value) {
                $coordinates = array();
                array_push($coordinates, $value->latitude);
                array_push($coordinates, $value->longitude);
                array_push($poins,$coordinates);
            }
            if($koridor_awal == $koridor_akhir){
                
                break;
            }
            $next = Rute::where('koridor_asal',$koridor_awal)->where('koridor_tujuan',$koridor_akhir)->first();
            $temp_start = $next->halte_transisi;
            $koridor_awal = $next->koridor_via;
            if($koridor_awal==0){
                $koridor_awal = $next->koridor_tujuan;
            }

        }
        // print_r($poins);
        // $hasil['asal'] = $cari->koridor_asal;        
        // $hasil['tujuan'] = $cari->koridor_tujuan;
        // $hasil['via'] = $cari->koridor_via;
        // $hasil['halte'] = $cari->halte_transisi;
        
        return json_encode($poins);
    }


    public function pencarian_halte($awal,$akhir)
    {
        $FeatureCollection = array(); 

        $halte = Point::with('Halte')->where('halte_id',$awal)->orWhere('halte_id',$akhir)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            if($value->halte_id==$akhir)$feature['properties']['marker-color'] = '#fc4353';
            else $feature['properties']['marker-color'] = '#00ff00';
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        return json_encode($FeatureCollection);

    }

    public function menampilkan_halte($awal,$akhir)
    {
        
       
        $FeatureCollection = array(); 

        $halte = Point::with('Halte')->get();
        foreach ($halte as $key => $value) {
            
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            if($value->halte_id==$akhir)$feature['properties']['marker-color'] = '#fc4353';
            else if($value->halte_id==$awal) $feature['properties']['marker-color'] = '#00ff00';
            else $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

    public function halte_k1a()
    {
        $FeatureCollection = array();        
        

        $halte = Point::with('Koridor')->get();
        foreach ($halte as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
       
        return json_encode($FeatureCollection);
    }

     public function halte_ungroup()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 3);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_ka1a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 1);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_k1b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 2);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_k2a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 3);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_k2b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 4);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_k3a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 5);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_k3b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 6);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_k5a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 7);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_k5b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 8);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }

     public function halte_k6a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 9);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }   

     public function halte_k6b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 10);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";            
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);

    }      


    public function rute1a()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 1);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }

    public function rute1b()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 2);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }





    public function rute2a()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 3);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }

    public function rute2b()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 4);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }




    public function rute3a()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 5);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    } 
    public function rute3b()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 6);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }




    public function rute5a()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 7);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    } 
    public function rute5b()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 8);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }    



     public function rute6a()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 9);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    } 
    public function rute6b()
    {
      $FeatureCollection = array();        
      
        $where = array('koridor_id' => 10);
        $rute = Point::with('Koridor')->where($where)->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    } 
}
