@extends('koridor_all')

@section('js_koridor_1')
 $.get( "/TransPadang/public/rute1a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'red'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "/TransPadang/public/rute1b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: '#red'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "/TransPadang/public/halte_ka1a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "/TransPadang/public/halte_k1b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
@endsection

@section('js_koridor_2')

 $.get( "/TransPadang/public/rute2a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'blue'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "/TransPadang/public/rute2b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'blue'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "/TransPadang/public/halte_k2a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "/TransPadang/public/halte_k2b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });                
@endsection

@section('js_koridor_3')

 $.get( "/TransPadang/public/rute3a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'green'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "/TransPadang/public/rute3b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'green'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "/TransPadang/public/halte_k3a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "/TransPadang/public/halte_k3b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });                
@endsection
@section('js_koridor_5')

 $.get( "/TransPadang/public/rute5a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'yellow'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "/TransPadang/public/rute5b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'yellow'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "/TransPadang/public/halte_k5a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "/TransPadang/public/halte_k5b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });                
@endsection

@section('js_koridor_6')

 $.get( "/TransPadang/public/rute6a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: '#000'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "/TransPadang/public/rute6b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: '#000'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "/TransPadang/public/halte_k6a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "/TransPadang/public/halte_k6b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });                
@endsection