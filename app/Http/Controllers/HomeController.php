<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Halte;
use App\Model\Koridor;
use App\Model\Kelurahan;
use App\Model\Kecamatan;

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

    public function halte()
    {
        $FeatureCollection = array();
        $FeatureCollection['type'] = "FeatureCollection";
        $FeatureCollection['crs'] = array();
        $FeatureCollection['crs']['type'] = "name";
        $FeatureCollection['crs']['properties'] = array();
        $FeatureCollection['crs']['properties']['name'] = "urn:ogc:def:crs:OGC:1.3:CRS84";
        $FeatureCollection['features'] = array();

        $where = array('koridor_id' => 1);
        $halte = Halte::with('Koridor')-> where($where)->
        get();
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
        // $FeatureCollection['route'] = array();
        // $FeatureCollection['route']['type'] = "geojson";
        // $FeatureCollection['route']['data'] = array();
        // $FeatureCollection['route']['data']['type'] = "line-string";
        // $FeatureCollection['coordinates'] = array();
        // var temp = 0;

        $halte = Halte::with('Koridor')->get();
        foreach ($halte as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        // $temp = count($FeatureCollection);
        // $temp = $temp-1;
        // $tempcor = $coordinate.";";
        
        // array_push($FeatureCollection, $temp);
        // // $FeatureCollection[$temp]= ;
        return json_encode($FeatureCollection);
    }

     public function halte_ungroup()
    {
        $FeatureCollection = array();
        $FeatureCollection['type'] = "FeatureCollection";
        $FeatureCollection['crs'] = array();
        $FeatureCollection['crs']['type'] = "name";
        $FeatureCollection['crs']['properties'] = array();
        $FeatureCollection['crs']['properties']['name'] = "urn:ogc:def:crs:OGC:1.3:CRS84";
        $FeatureCollection['features'] = array();

        $where = array('koridor_id' => 1);
        $halte = Halte::with('Koridor')-> where($where)->
        get();
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

}
