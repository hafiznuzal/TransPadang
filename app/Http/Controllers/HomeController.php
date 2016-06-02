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
    public function rute6b()
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
}
