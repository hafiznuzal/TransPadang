<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            $feature['properties']['marker-color'] = $value->Koridor->color;
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
