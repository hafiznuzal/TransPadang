@extends('test_ungroup')

@section('rute_js_pulang')

 $.get( "/TransPadang/public/rute1a", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: '#000'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);

    });

 $.get( "/TransPadang/public/halte_ka1a", function( data ) {
       
       
      	var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
      
       	
    });   
@endsection

@section('rute_js_pergi')

 $.get( "/TransPadang/public/rute1b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: '#000'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);

    });

 $.get( "/TransPadang/public/halte_k1b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
      
        
    });   
@endsection

